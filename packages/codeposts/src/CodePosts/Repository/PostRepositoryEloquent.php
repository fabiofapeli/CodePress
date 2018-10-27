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

    /*
	sobrescrevendo o método create/update será possível sincronizar os ids de tags e categories
    */
    public function create(array $data){
    	/** @var Post $post */
    	$post = parent::create($data);
    	$post->user()->associate($data['user']);
    	$post->save();
    	$categories = $data['categories'];
    	$tags = $data['tags'];
    	$post->categories()->sync($categories);
    	$post->tags()->sync($tags);
    }

    public function update(array $data, $id){
    	/** @var Post $post */
    	$post = parent::update($data, $id);
    	$categories = $data['categories'];
    	$tags = $data['tags'];
    	$post->categories()->sync($categories);
    	$post->tags()->sync($tags);
    }

}