<?php

use CodePress\CodeApp\Models\AppConfig;

/**
 * retorna mesmo caminho se o arquivo existir na pasta public ou arquivo na pasta do layout se não existir na public
 * @param string $path 
 * @param type|null $secure caso seja https
 * @return string
 */
function codeasset($path, $secure = null){
	
	if(!file_exists(public_path($path))){
		/** @var AppConfig $appConfig */
		$appConfig = app(AppConfig::class); //Utilização do serviço registrado em CodeAppServiceProvider
		$frontLayout = $appConfig->frontLayout;
		//Com ltrin conseguimos retirar a '/', caso seja passado algo '/css/style.css';
		$path = ltrim($path, '/'); 
		$path ="$frontLayout/$path"; //retorn path na pasta do template
	}

	return asset($path, $secure);
}