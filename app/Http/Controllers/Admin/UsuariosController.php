<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PesquisasRequest;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Repositories\StatusRepository;
use App\Repositories\UsuarioRepository;

class UsuariosController extends Controller
{
    public $usuarios;
    public $status;

    /**
     * UsuariosController constructor.
     * @param UsuarioRepository $usuarioRepository
     * @param StatusRepository $statusRepository
     */
    public function __construct(UsuarioRepository $usuarioRepository, StatusRepository $statusRepository)
    {
        parent::__construct();
        $this->middleware('auth:admin');

        $this->usuarios = $usuarioRepository;
        $this->status = $statusRepository;
    }

    /**
     * @param PesquisasRequest $pesquisasRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(PesquisasRequest $pesquisasRequest)
    {
        $usuarios = $this->usuarios->model()->orderBy('nome', 'ASC');
        if ($parametro = $pesquisasRequest->search) {
            $usuarios->where('nome', 'like', "%{$parametro}%")->orWhere('sobrenome', 'like', "%{$parametro}%")->orWhere('email', 'like', "%{$parametro}%");
        }
        return view('admin.usuarios.index', ['usuarios' => $usuarios->paginate(20)]);
    }

    /**
     * @param StoreUsuarioRequest $storeUsuarioRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(StoreUsuarioRequest $storeUsuarioRequest)
    {
        if ($storeUsuarioRequest->isMethod('post')) {
            if ($usuario = $this->usuarios->create($storeUsuarioRequest->only($this->usuarios->model()->getFillable()))) {
                flash('Usuário criado com sucesso')->success();
                return redirect()->route('admin.usuarios.index');
            }
            flash('Não foi possível criar o usuário')->error();
            return redirect()->back();
        }
        return view('admin.usuarios.create', ['status' => $this->status->model()->pluck('titulo', 'id')]);
    }

    /**
     * @param $id
     * @param UpdateUsuarioRequest $updateUsuarioRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id, UpdateUsuarioRequest $updateUsuarioRequest)
    {
        $usuario = $this->usuarios->find($id);
        if ($updateUsuarioRequest->isMethod('post')) {
            if ($usuario->find($id)->update($updateUsuarioRequest->only($this->usuarios->model()->getFillable()))) {
                flash('Usuário atualizado com sucesso')->success();
                return redirect()->route('admin.usuarios.index', [$id]);
            }
            flash('Não foi possível atualizar o usuário')->error();
            return redirect()->back();
        }
        if ($usuario) {
            return view('admin.usuarios.edit', [
                'usuario' => $usuario,
                'status' => $this->status->model()->pluck('titulo', 'id'),
            ]);
        }
        return redirect()->route('admin.usuarios.index');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if ($this->usuarios->model()->find($id)->delete()) {
            flash('Usuário enviado para lixeira')->info();
            return redirect()->route('admin.usuarios.index');
        }
        flash('Não foi possível remover este usuário')->error();
        return redirect()->back();
    }

    /**
     * Exibir itens removidos com softdeleted
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function trashed(PesquisasRequest $pesquisasRequest)
    {
        $usuarios = $this->usuarios->model()->onlyTrashed()->orderBy('deleted_at', 'DESC');
        if ($parametro = $pesquisasRequest->search) {
            $usuarios->where('nome', 'like', "%{$parametro}%")->orWhere('sobrenome', 'like', "%{$parametro}%")->orWhere('email', 'like', "%{$parametro}%");
        }
        return view('admin.usuarios.lixeira', [
                'usuarios' => $usuarios->paginate(20)
            ]
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $usuarios = $this->usuarios->model()->onlyTrashed()->where('id', $id)->first();
        if (!empty($usuarios)) {
            if ($usuarios->restore()) {
                flash('Usuário recuperado com sucesso.')->success();
                return redirect()->route('admin.usuarios.trashed');
            }
            flash('Não foi possível localizar o Usuário, parece que ele já foi removido')->error();
            return redirect()->route('admin.usuarios.index');
        }
        flash('Não foi possível recuperar o Usuário.')->error();
        return redirect()->route('admin.usuarios.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($id)
    {
        if ($this->usuarios->model()->onlyTrashed()->where('id', $id)->forceDelete()) {
            flash('Usuário removido da lixeira com sucesso')->success();
            return redirect()->route('admin.usuarios.trashed');
        }
        flash('Não é possível deletar este Usuário')->info()->important();
        return redirect()->back();
    }
}
