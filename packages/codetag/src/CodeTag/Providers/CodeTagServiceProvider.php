<?php

namespace CodePress\CodeTag\Providers;
 
use CodePress\CodeTag\Repository\TagRepositoryEloquent;
use CodePress\CodeTag\Repository\TagRepositoryInterface;
use Illuminate\Support\ServiceProvider;
 
class CodeTagServiceProvider extends ServiceProvider
{
 
   public function boot(){
       $this->publishes([__DIR__.'/../resources/migrations/'=>base_path('database/migrations')],'migrations');
       require __DIR__.'/../routes.php';
       $this->loadViewsFrom(__DIR__ . '/../resources/views/tags', 'codetag');
   }
 
   public function register()
   {
 	$this->app->bind(TagRepositoryInterface::class, TagRepositoryEloquent::class);
   }
 
}


