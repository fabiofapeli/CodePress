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
       $this->authorize('access_posts');
       $this->response = $response;
       $this->repository = $repository;
   }
    
    public function index(){
        $posts=$this->repository->all();
        return view("codepost::index",compact('posts'));
    }
    
    public function create(){
        return view('codepost::create');
   }
   
    public function edit($id){
        $post=$this->repository->find($id);
        return view('codepost::edit',compact('post'));
   }
   
   public function store(Request $request){
       $this->repository->create($request->all());
       return redirect()->route('admin.posts.index');
   }

    public function update(Request $request, $id){
      $data = $request->all();

      $category = $this->repository->update($data, $id);
      return redirect()->route('admin.posts.index');
    }

    public function updateState(Request $request, $id){
      $this->authorize('publish_post');
      $this->repository->updateState($id, $request->get('state'));
       return redirect()->route('admin.posts.edit', ['id' => $id]);
    }
}
