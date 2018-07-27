<?php

namespace CodePress\CodeUser\Controllers\Admin;
use CodePress\CodeUser\Controllers\Controller;
use CodePress\CodeUser\Repository\PermissionRepositoryInterface;
use CodePress\CodeUser\Repository\RoleRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    private $repository;
    private $response;
  private $permissionRepository;

   public function __construct(ResponseFactory $response,RoleRepositoryInterface $repository, PermissionRepositoryInterface $permissionRepository)
   {   
       $this->authorize('access_users');
       $this->response = $response;
       $this->repository = $repository;
    $this->permissionRepository = $permissionRepository;
   }
    
    public function index(){
        $roles = $this->repository->all();
        return view("codeuser::admin.role.index", compact('roles'));
    }
    
    public function create(){
        $permissions = $this->permissionRepository->lists('name', 'id');
        return view('codeuser::admin.role.create', compact('permissions'));
   }
   
   public function store(Request $request){
       $role = $this->repository->create($request->all());
       $this->repository->addPermissions($role->id,$request->get('permissions'));
       return redirect()->route('admin.roles.index');
   }

   public function edit($id){
      $permissions = $this->permissionRepository->lists('name', 'id');
       $role = $this->repository->find($id);
       return $this->response->view('codeuser::admin.role.edit', compact('role', 'permissions'));
   }

   public function update(Request $request, $id){
    $data = $request->all();
    
        $role = $this->repository->update($data, $id);
        $this->repository->addPermissions($role->id, $request->get('permissions'));
        return redirect()->route('admin.roles.index');
   }

    
}
