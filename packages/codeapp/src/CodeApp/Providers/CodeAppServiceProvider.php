<?php

namespace CodePress\CodeApp\Providers;
 
use CodePress\CodeApp\Models\AppConfig;
use CodePress\CodeApp\Models\Layout;
use Illuminate\Support\ServiceProvider;
 
class CodeAppServiceProvider extends ServiceProvider
{
 
   public function boot(){
       $this->publishes([__DIR__.'/../resources/migrations/'=>base_path('database/migrations')],'migrations');
       require __DIR__.'/../routes.php';
       $this->loadViewsFrom(__DIR__ . '/../resources/views/codeapp', 'codeapp');

       //Com o creating é possível manipular as informações no momento de criação do registro
       Layout::creating(
          function($layout){
            $layout->dirname = md5(time());
          }
       );

       /** @var AppConfig $model */
       /*
       $model = AppConfig::find(1);
       $model->frontLayout = "set funcionado";
       $model->save();

       dd(AppConfig::find(1)->frontLayout);
       dd(codeasset('favicon.ico'));
       */

   }
 
   public function register()
   {
   		//poderemos iniciar o serviço para AppConfig e pegar as configurações
 		$this->app->bind(AppConfig::class, function (){
 			return AppConfig::find(1);
 		});

   }
 
}


