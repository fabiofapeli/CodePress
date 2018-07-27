<?php
namespace CodePress\CodeUser\Repository;

use CodePress\CodeDatabase\Contracts\RepositoryInterface;
use CodePress\CodeDatabase\Contracts\CriteriaCollection;

interface UserRepositoryInterface extends RepositoryInterface, CriteriaCollection
{
	public function addRoles($id, array $roles);
}