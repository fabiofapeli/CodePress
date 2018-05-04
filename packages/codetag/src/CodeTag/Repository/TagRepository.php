<?php
namespace CodePress\CodeTag\Repository;

use CodePress\CodeTag\Models\Tag;
use CodePress\CodeDatabase\AbstractRepository;

class TagRepository extends AbstractRepository
{

    public function model() {
        return Tag::class;
    }

}