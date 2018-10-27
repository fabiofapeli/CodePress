<?php
namespace CodePress\CodeTag\Repository;

use CodePress\CodeTag\Models\Tag;
use CodePress\CodeDatabase\AbstractRepository;

class TagRepositoryEloquent extends AbstractRepository implements TagRepositoryInterface
{

    public function model() {
        return Tag::class;
    }

}