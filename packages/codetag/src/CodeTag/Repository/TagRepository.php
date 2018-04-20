<?php
namespace CodePress\CodeTag\Repository;

use CodePress\CodeTag\Models\Category;
use CodePress\CodeDatabase\AbstractRepository;

class TagRepository extends AbstractRepository
{

    public function model() {
        return Category::class;
    }

}