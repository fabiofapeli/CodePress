<?php

namespace CodePress\CodePosts\Controllers;
use CodePress\CodePosts\Repository\PostRepositoryInterface;
use CodePress\CodeTag\Repository\TagRepositoryInterface;
use CodePress\CodeCategory\Repository\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Auth;

class AdminPostController extends Controller
{
    private $repository;
    private $response;
    private $tagRepository;
    private $categoryRepository;

   public function __construct(
                                ResponseFactory $response,
                                PostRepositoryInterface $repository,
                                CategoryRepositoryInterface $categoryRepository,
                                TagRepositoryInterface $tagRepository
                              )
   {   
       $this->response = $response;
       $this->repository = $repository;
       $this->categoryRepository = $categoryRepository;
       $this->tagRepository = $tagRepository;

   }
    
    public function index(){
        $posts=$this->repository->all();
        return view("codepost::index",compact('posts'));
    }
    
    public function create(){
        $categories = $this->categoryRepository->all()->lists('name', 'id');
        $tags = $this->tagRepository->all()->lists('name', 'id');
        return view('codepost::create', compact('categories', 'tags'));
   }
   
    public function edit($id){
        $categories = $this->categoryRepository->all()->lists('name', 'id');
        $tags = $this->tagRepository->all()->lists('name', 'id');
        $post = $this->repository->find($id);
        return view('codepost::edit',compact('post', 'categories', 'tags'));
   }
   
   public function store(Request $request){
       $data = $request->all();
       $data['user'] = Auth::user();
       $this->repository->create($data);
       return redirect()->route('admin.posts.index');
   }

    public function update(Request $request, $id){
      $data = $request->all();

      $category = $this->repository->update($data, $id);
      return redirect()->route('admin.posts.index');
    }

    public function updateState(Request $request, $id){
     // $this->authorize('publish_post');
      $this->repository->updateState($id, $request->get('state'));
       return redirect()->route('admin.posts.edit', ['id' => $id]);
    }
}
