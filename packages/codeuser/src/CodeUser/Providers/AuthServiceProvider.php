<?php

namespace CodePress\CodeUser\Providers;

use CodePress\CodeUser\Repository\PermissionRepositoryInterface;
use App\Policies\CategoryPolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy'
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //não executa no terminal para evitar erros
        if(!app()->runningInConsole() || app()->runningUnitTests()){ 
            $permissionRepository = app(PermissionRepositoryInterface::class);
            $permissions = $permissionRepository->all();
            foreach ($permissions as $p) {
                //Definição das habilidades
                $gate->define($p->name, function ($user) use ($p) {
                    //poderia também ser usado um Before para verificar se o usuário é administrador
                    return $user->isAdmin() || $user->hasRole($p->roles);
                });
            }
        }
        
    }
}
