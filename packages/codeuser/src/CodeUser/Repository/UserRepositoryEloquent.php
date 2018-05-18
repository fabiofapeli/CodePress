<?php
namespace CodePress\CodeUser\Repository;

use CodePress\CodeUser\Models\User;
use CodePress\CodeDatabase\AbstractRepository;

class UserRepositoryEloquent extends AbstractRepository implements UserRepositoryInterface
{

    public function model() {
        return User::class;
    }

}