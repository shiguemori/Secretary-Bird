<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerAclPolicies();
    }

    /**
     * Politica validadora de acessos e visualização de recursos
     * Valida se o usuário logado tem permissão a determinadas ações utilizando o @can nas views.
     * É necessário passar o nome completo da rota registrada na tabela de rotas_permissoes
     * Exemplo: @can('acl.view', 'ideal.web.renderRegrasOrcamentos') <button>Gerar orçamentos</button> @endcan
     * @var $user = objeto de usuario Autenticado, não é necessário passa-lo na can, o mesmo é default.
     * @var $rota_name = string com o nome da rota, deve ser informado na view dentro da @can como no exemplo acima
     */
    public function registerAclPolicies()
    {
        Gate::define('acl.view', function ($user, $rota_name) {
            return $user->hasPermissao($rota_name);
        });
    }
}
