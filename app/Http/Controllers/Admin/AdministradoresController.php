<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PesquisasRequest;
use App\Http\Requests\StoreAdministradorRequest;
use App\Http\Requests\UpdateAdministradorRequest;
use App\Repositories\AdministradorRepository;
use App\Repositories\GrupoRepository;
use App\Repositories\StatusRepository;
use App\Http\Controllers\Controller;
use App\Services\ControleAcessoService;
use Illuminate\Support\Facades\Auth;

class AdministradoresController extends Controller
{
    protected $administradores;
    protected $grupos;
    protected $status;

    /**
     * AdministradoresController constructor.
     * @param AdministradorRepository $administradorRepository
     * @param GrupoRepository $grupoRepository
     * @param StatusRepository $statusGeralRepository
     */
    public function __construct(AdministradorRepository $administradorRepository, GrupoRepository $grupoRepository, StatusRepository $statusGeralRepository)
    {
        parent::__construct();
        $this->middleware('auth:admin');

        $this->administradores = $administradorRepository;
        $this->grupos = $grupoRepository;
        $this->status = $statusGeralRepository;
    }

    /**
     * @param PesquisasRequest $pesquisasRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(PesquisasRequest $pesquisasRequest)
    {
        $administradores = $this->administradores->model()->orderBy('nome', 'ASC');
        if ($parametro = $pesquisasRequest->search) {
            $administradores->where('nome', 'like', "%{$parametro}%")->orWhere('sobrenome', 'like', "%{$parametro}%")->orWhere('email', 'like', "%{$parametro}%");
        }
        return view('admin.administradores.index', [
            'administradores' => $administradores->paginate(20),
        ]);

    }

    /**
     * @param ControleAcessoService $controleAcessoService
     * @param StoreAdministradorRequest $storeAdministradorRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(ControleAcessoService $controleAcessoService, StoreAdministradorRequest $storeAdministradorRequest)
    {
        if ($storeAdministradorRequest->isMethod('post')) {
            if ($this->administradores = $this->administradores->model()->create($storeAdministradorRequest->only($this->administradores->model()->getFillable()))) {
                $this->administradores->grupos()->sync($storeAdministradorRequest->grupos);
                $this->administradores->administradores_permissoes()->sync(array_keys($storeAdministradorRequest->permissoes));
                flash('Administrador criado com sucesso')->success();
                return redirect()->route('admin.administradores.index');
            }
            flash('Não foi possível criar o administrador')->error();
            return redirect()->back();
        }

        return view('admin.administradores.create', [
            'status' => $this->status->model()->pluck('titulo', 'id'),
            'grupos' => $this->grupos->model()->pluck('titulo', 'id'),
            'permissoes' => $controleAcessoService->processaPermissoesArray()
        ]);
    }

    /**
     * @param $id
     * @param UpdateAdministradorRequest $updateAdministradorRequest
     * @param ControleAcessoService $controleAcessoService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id, UpdateAdministradorRequest $updateAdministradorRequest, ControleAcessoService $controleAcessoService)
    {
        if ($updateAdministradorRequest->isMethod('post')) {
            if ($this->administradores->model()->find($id)->update($updateAdministradorRequest->only($this->administradores->model()->getFillable()))) {
                $this->administradores->model()->find($id)->grupos()->sync($updateAdministradorRequest->grupos);
                $this->administradores->model()->find($id)->administradores_permissoes()->sync(array_keys($updateAdministradorRequest->permissoes));
                flash('Administrador atualizado com sucesso')->success();
                return redirect()->route('admin.administradores.index');
            }
            flash('Não foi possível atualizar o usuário')->error();
            return redirect()->back();
        }

        if ($this->administradores = $this->administradores->model()->find($id)) {
            return view('admin.administradores.edit', [
                'grupos' => $this->grupos->model()->pluck('titulo', 'id'),
                'grupo' => $this->administradores->grupos()->first(),
                'administradores' => $this->administradores,
                'status' => $this->status->model()->pluck('titulo', 'id'),
                'permissoes' => $controleAcessoService->processaPermissoesArray($id)
            ]);
        }
        return redirect()->route('admin.administradores.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if ($id == Auth::guard('admin')->user()->id) {
            flash('Você não pode deletar seu próprio usuário.')->error();
            return redirect()->back();
        }

        if ($this->administradores->model()->find($id)->delete()) {
            flash('Administrador enviado para lixeira')->info();
            return redirect()->route('admin.administradores.index');
        }
        flash('Não foi possível remover este administrador')->error();
        return redirect()->back();
    }

    /**
     * Exibir itens removidos com softdeleted
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function trashed(PesquisasRequest $pesquisasRequest)
    {
        $administradores = $this->administradores->model()->orderBy('nome', 'ASC')->onlyTrashed()->orderBy('deleted_at', 'DESC');
        if ($parametro = $pesquisasRequest->search) {
            $administradores->where('nome', 'like', "%{$parametro}%")->orWhere('sobrenome', 'like', "%{$parametro}%")->orWhere('email', 'like', "%{$parametro}%");
        }

        return view('admin.administradores.lixeira', [
                'administradores' => $administradores->paginate(20)
            ]
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $administradores = $this->administradores->model()->onlyTrashed()->where('id', $id)->first();
        if (!empty($administradores)) {
            if ($administradores->restore()) {
                flash('Administrador recuperado com sucesso.')->success();
                return redirect()->route('admin.administradores.trashed');
            }
            flash('Não foi possível localizar o Administrador, parece que ele já foi removido')->error();
            return redirect()->route('admin.administradores.index');
        }
        flash('Não foi possível recuperar o Administrador.')->error();
        return redirect()->route('admin.administradores.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($id)
    {
        if ($this->administradores->model()->onlyTrashed()->where('id', $id)->forceDelete()) {
            flash('Administrador removido da lixeira com sucesso')->success();
            return redirect()->route('admin.administradores.trashed');
        }
        flash('Não é possível deletar este Administrador')->info()->important();
        return redirect()->back();
    }
}
