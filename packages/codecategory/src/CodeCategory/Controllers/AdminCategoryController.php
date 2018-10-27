<?php

namespace CodePress\CodeCategory\Controllers;
use CodePress\CodeCategory\Repository\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use StdClass;

class AdminCategoryController extends Controller
{
    private $repository;
    private $response;

   public function __construct(ResponseFactory $response,CategoryRepositoryInterface $repository)
   {   
       //$this->authorize('access_categories');
       $this->response = $response;
       $this->repository = $repository;
   }
    
    public function index(){
        $categories = $this->repository->all();
        return view("codecategory::index",compact('categories'));
    }
    
    public function create(){
        $categories = $this->repository->all();
        $category = new StdClass;
        $category->parent_id = 0;
        return view('codecategory::create',compact('categories','category'));
   }
    
    public function edit($id){
        $category = $this->repository->find($id);
        $categories = $this->repository->all();
        return view('codecategory::edit',compact('categories', 'category'));
   }
   
   public function store(Request $request){
       $this->repository->create($request->all());
       return redirect()->route('admin.categories.index');
   }

    
}
