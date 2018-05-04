<?php

namespace CodePress\CodePosts\Controllers;
use CodePress\CodePosts\Repository\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;

class AdminPostController extends Controller
{
    private $repository;
    private $response;

   public function __construct(ResponseFactory $response,PostRepositoryInterface $repository)
   {   
       $this->response = $response;
       $this->repository = $repository;
   }
    
    public function index(){
        $posts=$this->repository->all();
        return view("codepost::index",compact('posts'));
    }
    
    public function create(){
        $posts=$this->repository->all();
        return view('codepost::create',compact('posts'));
   }
   
   public function store(Request $request){
       $this->repository->create($request->all());
       return redirect()->route('admin.posts.index');
   }

    
}
