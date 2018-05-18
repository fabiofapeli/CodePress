<?php
namespace CodePress\CodeUser\Providers;

use CodePress\CodeUser\Repository\UserRepositoryEloquent;
use CodePress\CodeUser\Repository\UserRepositoryInterface;
use CodePress\CodeUser\Routing\Router;
use Illuminate\Support\ServiceProvider;

class CodeUserServiceProvider extends ServiceProvider
{

    public function boot(){
        $this->publishes([
            __DIR__.'/../../config/auth.php'=>base_path('config/auth.php')
        ],'config');
        $this->publishes([
            __DIR__.'/../../resources/migrations/'=>base_path('database/migrations')
        ],'migrations');
        $this->publishes([
            __DIR__.'/../../resources/views/auth'=>base_path('resources/views/auth')
        ],'auth');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/codeuser', 'codeuser');
        require __DIR__.'/../routes.php';
    }

    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepositoryEloquent::class);
        //método singleton cria uma única instância do serviço mesmo que chamado diversas vezes
        $this->app->singleton('codepress_user_route', function(){
            return new Router();
        }); 
    }

}