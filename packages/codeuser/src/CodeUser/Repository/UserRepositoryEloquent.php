<?php
namespace CodePress\CodeUser\Repository;

use CodePress\CodeUser\Models\User;
use CodePress\CodeUser\Event\UserCreatedEvent;
use CodePress\CodeDatabase\AbstractRepository;

class UserRepositoryEloquent extends AbstractRepository implements UserRepositoryInterface
{

    /**
     * @var RoleRepositoryInterface
     */
    private $roleRepository;
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        parent::__construct();
        $this->roleRepository = $roleRepository;
    }
    
	//sobrescrevendo a lógica de create
	public function create(array $data){
		$password = $data['password']; //plain password (password puro)
		$data['password'] = bcrypt($password);
		$result = parent::create($data);
		event(new UserCreatedEvent($result, $password));// Event::fire outra forma de chamar um evento
		return $result;
	}

    public function model() {
        return User::class;
    }

    /**
     * Adiciona roles aos usuários
     * @param int $id id do usuário
     * @param array $roles roles que serão adicionadas ao usuário
     * @return User $model
     */
    public function addRoles($id, array $roles)
    {
        $model = $this->find($id);
        $model->roles()->sync($roles);
        return $model;
    }

}