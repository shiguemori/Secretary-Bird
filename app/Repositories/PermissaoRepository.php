<?php

namespace App\Repositories;

use App\Models\Permissao;

class PermissaoRepository extends BaseRepository
{
    public $model;

    /**
     * PermissaoRepository constructor.
     * @param Permissao $Permissao
     */
    public function __construct(Permissao $Permissao)
    {
        $this->model = $Permissao;
    }

    /**
     * @param $rotas
     * @return mixed
     */
    public function sincronizaRotas($rotas, $rota_parent = null)
    {
        foreach ($rotas as $rota) {
            if (!$this->model()->where('rota', $rota)->first()) {
                $this->create([
                    'label' => str_replace('.', ' ', $rota),
                    'rota' => $rota,
                    'permissao_id' => $rota_parent
                ]);
            }
        }
        return $this->all();
    }

    /**
     * @param $controllers
     */
    public function sincronizaController($controllers)
    {
        foreach ($controllers as $controller => $rotas) {
            if (!$this->model()->where('controller', $controller)->first()) {
                $rotas_permissao = $this->create([
                    'label' => $controller,
                    'controller' => $controller,
                ]);
                $this->sincronizaRotas($rotas, $rotas_permissao->id);
            }
        }
    }

    /**
     * @param $permissoes
     * @return bool
     */
    public function atualizaTodos($permissoes)
    {
        foreach ($permissoes['label'] as $id_permissao => $label) {
            $this->find($id_permissao)->update(['label' => $label]);
        }
        foreach ($permissoes['icone'] as $id_permissao => $icon) {
            $this->find($id_permissao)->update(['icone' => $icon]);
        }
        foreach ($permissoes['permissao_id'] as $id_permissao => $rota_parent) {
            $this->find($id_permissao)->update(['permissao_id' => $rota_parent]);
        }
        if (isset($permissoes['visivel_menu'])) {
            foreach ($permissoes['visivel_menu'] as $id_permissao => $visivel_menu) {
                $this->model->whereNotIn('id', [$id_permissao])->update(['visivel_menu' => 0]);
            }
            foreach ($permissoes['visivel_menu'] as $id_permissao => $visivel_menu) {
                $this->model->whereIn('id', [$id_permissao])->update(['visivel_menu' => 1]);
            }
        } else {
            foreach ($this->model->all() as $permissao) {
                $permissao->update(['visivel_menu' => 0]);
            }
        }
        if (isset($permissoes['visivel_user'])) {
            foreach ($permissoes['visivel_user'] as $id_permissao => $visivel_user) {
                $this->model->whereNotIn('id', [$id_permissao])->update(['visivel_user' => 0]);
            }
            foreach ($permissoes['visivel_user'] as $id_permissao => $visivel_user) {
                $this->model->whereIn('id', [$id_permissao])->update(['visivel_user' => 1]);
            }
        } else {
            foreach ($this->model->all() as $permissao) {
                $permissao->update(['visivel_user' => 0]);
            }
        }
        if (isset($permissoes['mobile'])) {
            foreach ($permissoes['mobile'] as $id_permissao => $mobile) {
                $this->model->whereNotIn('id', [$id_permissao])->update(['mobile' => 0]);
            }
            foreach ($permissoes['mobile'] as $id_permissao => $mobile) {
                $this->model->whereIn('id', [$id_permissao])->update(['mobile' => 1]);
            }
        } else {
            foreach ($this->model->all() as $permissao) {
                $permissao->update(['mobile' => 0]);
            }
        }
        return true;
    }
}