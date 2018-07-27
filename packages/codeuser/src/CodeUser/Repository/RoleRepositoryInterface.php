<?php
namespace CodePress\CodeUser\Repository;

use CodePress\CodeDatabase\Contracts\RepositoryInterface;
use CodePress\CodeDatabase\Contracts\CriteriaCollection;

interface RoleRepositoryInterface extends RepositoryInterface, CriteriaCollection
{
	//Adicionar permissões nas roles
	public function addPermissions($id, array $permissions);
	public function lists($column, $key = null);
}
