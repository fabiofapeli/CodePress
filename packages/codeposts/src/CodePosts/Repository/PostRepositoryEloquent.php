<?php
namespace CodePress\CodePosts\Repository;

use CodePress\CodePosts\Models\Post;
use CodePress\CodeDatabase\AbstractRepository;

class PostRepositoryEloquent extends AbstractRepository implements PostRepositoryInterface
{

    public function model() {
        return Post::class;
    }

    public function updateState($id, $state){
    	$post = $this->find($id);
    	$post->state = $state;
    	$post->save();
    	return $post;
    }

}