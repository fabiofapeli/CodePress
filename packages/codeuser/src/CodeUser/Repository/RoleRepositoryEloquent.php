<?php
namespace CodePress\CodeUser\Repository;
use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodeUser\Models\Role;

class RoleRepositoryEloquent extends AbstractRepository implements RoleRepositoryInterface
{
    /**
     * @var PermissionRepositoryInterface
     */
    private $permissionRepository;

    /*
    Iremos usar permissionRepository para criar as permissions atreladas a Role
    Sobrescrevemos o método construtor do model Role
    */
    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        parent::__construct();
        $this->permissionRepository = $permissionRepository;
    }

    public function model()
    {
        return Role::class;
    }

    /**
     * Adiciona permissions a role
     * @param int $id id da role
     * @param array $permissions 
     * @return Role role
     */
    public function addPermissions($id, array $permissions)
    {
        $model = $this->find($id);
        $model->permissions()->sync($permissions);
        return $model;
    }

    public function lists($column, $key = null)
    {
        $this->applyCriteria();
        return $this->model->lists($column,$key);
    }
    
}