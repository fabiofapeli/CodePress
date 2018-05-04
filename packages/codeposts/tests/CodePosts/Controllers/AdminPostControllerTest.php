<?php

namespace CodePress\CodePosts\Tests\Controllers;

use CodePress\CodePosts\Controllers\Controller;
use CodePress\CodePosts\Controllers\AdminPostController;
use CodePress\CodePosts\Tests\AbstractTestCase;
use CodePress\CodePosts\Repository\PostRepositoryEloquent;
use Illuminate\Contracts\Routing\ResponseFactory;
use Mockery as m;

class AdminPostControllerTest extends AbstractTestCase
{

    public function test_should_extend_from_controller(){
        
        $repository = m::mock(PostRepositoryEloquent::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminPostController($responseFactory, $repository);    
        $this->assertInstanceOf(Controller::class, $controller); 
        
    }
    /*
    public function test_controller_should_run_index_method_and_return_correct_argument(){
         
        $responseFactory = m::mock(ResponseFactory::class);
        $Post = m::mock(Post::class);
        $controller = new AdminPostController($responseFactory, $Post);
        $html = m::mock();
        
        $categoriesResult = ['cat1', 'cat2'];
        $Post->shouldReceive('all')->andReturn($categoriesResult);
        $responseFactory->shouldReceive('view')
                ->with('codePosts::index', ['categories' => $categoriesResult]) //parâmetros obrigatórios
                ->andReturn($html); // objeto qualquer
        
        $this->assertEquals($controller->index(), $html);
    }
     */
    
    
}

