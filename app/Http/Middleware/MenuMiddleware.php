<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Facades\Agent;

class MenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $arrMenu = $this->montaMenu();
        app('view')->composer('layouts.master', function ($view) use ($arrMenu) {
            $controller = explode('@', str_replace('Controller', '', class_basename(app('request')->route()->getAction()['controller'])))[0];
            $view->with(compact('controller', 'arrMenu'));
            Paginator::defaultView('pagination::view');
            Paginator::defaultSimpleView('pagination::view');
        });

        return $next($request);
    }

    public function montaMenu()
    {
        $arrPermissoes = [];
        if (Auth::guard('admin')->check()) {
            foreach ($this->rotasPorDispositivos() as $permissao) {
                if ($permissao->permissao_id === null) {
                    $arrPermissoes[$permissao->id] = [
                        'nome' => $permissao->label,
                        'rota' => $permissao->rota,
                        'icone' => $permissao->icone,
                        'exibe_menu' => $permissao->visivel_menu,
                        'childs' => []
                    ];
                }
                foreach ($permissao->permissoes()->where('visivel_menu', 1)->orderBy('label', 'ASC')->get() as $rota_parent) {
                    if (Auth::guard('admin')->user()->hasPermissao($rota_parent->rota)) {
                        $arrPermissoes[$permissao->id]['childs'][$rota_parent->id] = [
                            'nome' => $rota_parent->label,
                            'rota' => $rota_parent->rota,
                            'icone' => $rota_parent->icone,
                            'exibe_menu' => $rota_parent->visivel_menu,
                        ];
                    }
                }
            }
        }
        return $arrPermissoes;
    }

    public function rotasPorDispositivos()
    {
        if (Agent::isMobile() || Agent::isTablet()) {
            return Auth::guard('admin')->user()->administradores_permissoes()->where('visivel_menu', 1)->where('mobile', 1)->orderBy('label', 'ASC')->get();
        }
        return Auth::guard('admin')->user()->administradores_permissoes()->where('visivel_menu', 1)->orderBy('label', 'ASC')->get();
    }
}
