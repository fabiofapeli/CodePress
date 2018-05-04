<?php
namespace CodePress\CodePosts\Repository;

use CodePress\CodePosts\Models\Post;
use CodePress\CodeDatabase\AbstractRepository;

class PostRepositoryEloquent extends AbstractRepository implements PostRepositoryInterface
{

    public function model() {
        return Post::class;
    }

}