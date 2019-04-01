<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateRotasPermissoesRequest;
use App\Repositories\PermissaoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

class PermissoesController extends Controller
{
    protected $rotaPermissao;

    /**
     * PermissoesController constructor.
     * @param PermissaoRepository $rotaPermissaoRepository
     */
    public function __construct(PermissaoRepository $rotaPermissaoRepository)
    {
        parent::__construct();
        $this->middleware('auth:admin');
        $this->rotaPermissao = $rotaPermissaoRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $rotasParentNull = $this->rotaPermissao->model()->whereNull('permissao_id')->pluck('label', 'id');
        $this->rotaPermissao = $this->store($this->rotaPermissao->model());
        return view('admin.permissoes.index', [
            'permissoes' => $this->rotaPermissao,
            'rotas' => $rotasParentNull,
        ]);
    }

    /**
     * Este mêtodo obtem as rotas e a controller fazendo um agrupamentos
     * Depois do agrupamento de rotas com controller, são verificados todas as rotas ainda não adicionadas e não agrupadas
     * estas devem ser agrupadas de forma manual, geralmente são rotas de api
     * @param $permissoes
     * @return mixed
     */
    public function store($permissoes)
    {
        $controller = [];
        $rotas = [];
        foreach (Route::getRoutes() as $route) {
            if (!empty($route->getName())) {
                if (stripos($route->getName(), 'admin.') !== false) {
                    $controller[explode('@', str_replace('Controller', '', class_basename($route->getAction()['controller'])))[0]][] = $route->getName();
                    $rotas[] = $route->getName();
                }
            }
        }
        if (count($controller) > $permissoes->whereNotNull('controller')->count()) {
            $this->rotaPermissao->sincronizaController($controller);
        }
        if (count($rotas) > $permissoes->whereNotNull('rota')->count()) {
            $permissoes = $this->rotaPermissao->sincronizaRotas($rotas);
            flash('Novas rotas foram adicionadas às permissões de usuários')->success();
            return $permissoes;
        }
        return $permissoes->orderBy('id', 'ASC')->orderBy('permissao_id', 'ASC')->get();
    }

    /**
     * @param UpdateRotasPermissoesRequest $updateRotasPermissoesRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRotasPermissoesRequest $updateRotasPermissoesRequest)
    {
        if ($updateRotasPermissoesRequest->isMethod('post')) {
            $this->rotaPermissao->atualizaTodos($updateRotasPermissoesRequest->all());
            flash('Permissões atualizadas com sucesso')->success();
            return redirect()->back();
        }
        flash('Não foi possível atualizar as permissões')->error();
        return redirect()->back();
    }
}
