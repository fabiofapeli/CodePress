<?php
namespace CodePress\CodeUser\Repository;

use CodePress\CodeUser\Models\User;
use CodePress\CodeUser\Event\UserCreatedEvent;
use CodePress\CodeDatabase\AbstractRepository;

class UserRepositoryEloquent extends AbstractRepository implements UserRepositoryInterface
{
	//sobrescrevendo a lógica de create
	public function create(array $data){
		$password = $data['password']; //plain password (password puro)
		$data['password'] = bcrypt($password);
		$result = parent::create($data);
		#event(new UserCreatedEvent($result, $password));// Event::fire outra forma de chamar um evento
		#event('event.codepress', ["meu parametro 1", "meu parametro 2"]);
		event('event.numero1');
		return $result;
	}

    public function model() {
        return User::class;
    }

}