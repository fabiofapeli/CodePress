<?php
namespace CodePress\CodeCategory\Providers;

use Illuminate\Support\ServiceProvider;
use CodePress\CodeCategory\Repository\CategoryRepositoryInterface;
use CodePress\CodeCategory\Repository\CategoryRepositoryEloquent;

class CodeCategoryServiceProvider extends ServiceProvider
{

    public function boot(){
        $this->publishes([__DIR__.'/../resources/migrations/'=>base_path('database/migrations')],'migrations');
        require __DIR__.'/../routes.php';
        $this->loadViewsFrom(__DIR__ . '/../resources/views/categories', 'codecategory');
    }

    public function register()
    {
        /**
         * Com o método bind podemos registrar um serviço que poderá ser usado
         * em qualquer lugar da nossa aplicação através de um método injection
         */
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepositoryEloquent::class);
    }

}