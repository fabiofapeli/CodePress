<?php

namespace CodePress\CodeUser\Controllers\Admin;
use CodePress\CodeUser\Controllers\Controller;
use CodePress\CodeUser\Repository\PermissionRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    private $repository;
    private $response;
    
    public function __construct(ResponseFactory $response, PermissionRepositoryInterface $repository)
    {
        $this->authorize('access_users');
        $this->repository = $repository;
        $this->response = $response;
    }

    public function index()
    {
        $permissions = $this->repository->all();
        return $this->response->view('codeuser::admin.permission.index', compact('permissions'));
    }

    public function show($id)
    {
        $permission = $this->repository->find($id);
        return $this->response->view('codeuser::admin.permission.show', compact('permission'));
    }
}