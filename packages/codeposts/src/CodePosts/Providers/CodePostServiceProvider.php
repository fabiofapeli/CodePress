<?php
namespace CodePress\CodePosts\Providers;

use CodePress\CodePosts\Repository\PostRepositoryEloquent;
use CodePress\CodePosts\Repository\PostRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class CodePostServiceProvider extends ServiceProvider
{

    public function boot(){
        $this->publishes([__DIR__.'/../resources/migrations/'=>base_path('database/migrations')],'migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views/codepost', 'codepost');
        require __DIR__.'/../routes.php';
    }

    public function register()
    {
        /**
         * Com o método bind podemos registrar um serviço que poderá ser usado
         * em qualquer lugar da nossa aplicação através de um método injection
         */
        $this->app->bind(PostRepositoryInterface::class, PostRepositoryEloquent::class);
    }

}