<?php

namespace CodePress\CodeUsers\Controllers;
use CodePress\CodeUsers\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;

class UsersController extends Controller
{
    private $repository;
    private $response;

   public function __construct(ResponseFactory $response,UserRepositoryInterface $repository)
   {   
       $this->response = $response;
       $this->repository = $repository;
   }
    
    public function index(){
        $users=$this->repository->all();
        return view("codeuser::index",compact('users'));
    }
    
    public function create(){
        $users=$this->repository->all();
        return view('codeuser::create',compact('users'));
   }
   
   public function store(Request $request){
       $this->repository->create($request->all());
       return redirect()->route('admin.users.index');
   }

    
}
