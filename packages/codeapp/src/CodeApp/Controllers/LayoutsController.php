<?php

namespace CodePress\CodeApp\Controllers;

use CodePress\CodeApp\Models\AppConfig;
use CodePress\CodeApp\Models\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LayoutsController extends Controller
{
	private $layout;

	public function __construct(Layout $layout)
	{
		$this->layout = $layout;
	}

    public function index(){
        $layouts = $this->layout->all();
        //codeapp registrado em CodeAppServiceProvider
        return view('codeapp::layouts.index', compact('layouts'));
    }

   public function create(){
        return view('codeapp::layouts.create');
   }
    
   public function store(Request $request){
   	 $layout = $this->layout->create([
   	 		'name' => $request->get('name')
   	 	]
   	 );
   	 $file = $request->file('layout');

   	 //classe do php para manipular arquivos zip
   	 $zip = new \ZipArchive();
	
	   //haverá uma cópia de todos os layouts para que possam ser ativados
     $layoutPath = storage_path("app/layouts/$layout->dirname");

     //layout ativo na pasta public
     $publicPath = public_path("layouts/$layout->dirname");

      //Caso o arquiva exista e seja aberto sem erro
   	 if($zip->open($file->getRealPath()) == true){
        //descompactação na pasta storage/app/layouts
     	 	$zip->extractTo($layoutPath); 
     	 	$zip->close();
   	 }
     File::copyDirectory($layoutPath, $publicPath);
     File::delete("$publicPath/layout.blade.php");

   	 return redirect()->route('admin.layouts.index');
   }

   public function active($id){
    $layout = $this->layout->find($id);
    $appConfig = app(AppConfig::class);
    $appConfig->frontLayout = $layout->dirname;
    $appConfig->save();
    return redirect()->route('admin.layouts.index');
   }
    
}
