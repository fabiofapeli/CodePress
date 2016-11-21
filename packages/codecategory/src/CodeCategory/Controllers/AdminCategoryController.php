<?php

namespace CodePress\CodeCategory\Controllers;
use CodePress\CodeCategory\Repository\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;

class AdminCategoryController extends Controller
{
    private $repository;
    private $response;

   public function __construct(ResponseFactory $response,CategoryRepositoryInterface $repository)
   {   
       $this->response = $response;
       $this->repository = $repository;
   }
    
    public function index(){
        $categories=$this->repository->all();
        return view("codecategory::index",compact('categories'));
    }
    
    public function create(){
        $categories=$this->repository->all();
        return view('codecategory::create',compact('categories'));
   }
   
   public function store(Request $request){
       $this->repository->create($request->all());
       return redirect()->route('admin.categories.index');
   }

    
}
