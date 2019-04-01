<?php

namespace App\Services;

use App\Models\Permissao;
use Illuminate\Support\Facades\Auth;

class ControleAcessoService
{
    /**
     * Processa e retorna lista de permissões, marcando as ativas, segundo o parâmetro "$selecionadas"
     * @param null $id
     * @return array
     */
    public function processaPermissoesArray($id = null)
    {
        $selecionadas = [];
        if (!empty($id)) {
            $selecionadas = Permissao::where('visivel_user', 1)->whereHas('administrador', function ($query) use ($id) {
                $query->where('administrador_id', $id);
            })->pluck('id')->toArray();
        }
        $permissoes = Permissao::where('visivel_user', 1)->whereNull('permissao_id')->orderBy('id')->get();
        $arrPermissoes = [];

        foreach ($permissoes as $permissao) {
            if ($permissao->permissao_id === null) {
                $arrPermissoes[$permissao->id] = [
                    'icone' => (!is_null($permissao->icone) ? $permissao->icone : 'mdi mdi-lock'),
                    'nome' => $permissao->label,
                    'ativo' => (count($selecionadas) && in_array($permissao->id, $selecionadas) ? 1 : 0),
                    'childs' => []
                ];
            }
            foreach ($permissao->permissoes()->where('visivel_user', 1)->get() as $rota_parent) {
                $arrPermissoes[$permissao->id]['childs'][$rota_parent->id] = [
                    'nome' => $rota_parent->label,
                    'ativo' => (count($selecionadas) && in_array($rota_parent->id, $selecionadas) ? 1 : 0),
                ];
            }
        }
        return $arrPermissoes;
    }

    static public function controleAcesso($rota)
    {
        if (Auth::guard('admin')->check()) {
            if (Auth::guard('admin')->user()->administradores_permissoes()->where('rota', $rota)->count() == 1) {
                return true;
            }
        }
        return false;
    }
}