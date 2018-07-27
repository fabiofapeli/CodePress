<?php
namespace CodePress\CodeUser\Repository;
use CodePress\CodeDatabase\Contracts\CriteriaCollection;
use CodePress\CodeDatabase\Contracts\RepositoryInterface;

interface PermissionRepositoryInterface extends RepositoryInterface, CriteriaCollection
{
    public function lists($column, $key = null);
}