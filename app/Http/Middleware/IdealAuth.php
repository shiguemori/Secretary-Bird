<?php

namespace App\Http\Middleware;

use App\Services\IdealAuthService;
use Closure;

class IdealAuth
{
    /**
     * Handle an incoming request.
     * Validar se o token do request é válido
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $idealAuth = new IdealAuthService($request);
        if (!$idealAuth->autorizaUser()) {
            return response('Você não tem permissão para logar.', '403');
        }
        return $next($request);
    }
}
