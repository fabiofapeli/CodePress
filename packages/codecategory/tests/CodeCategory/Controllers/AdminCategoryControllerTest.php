<?php

namespace CodePress\CodeCategory\Tests\Controllers;

use CodePress\CodeCategory\Controllers\Controller;
use CodePress\CodeCategory\Controllers\AdminCategoryController;
use CodePress\CodeCategory\Tests\AbstractTestCase;
use CodePress\CodeCategory\Repository\CategoryRepositoryEloquent;
use Illuminate\Contracts\Routing\ResponseFactory;
use Mockery as m;

class AdminCategoryControllerTest extends AbstractTestCase
{

    public function test_should_extend_from_controller(){
        
        $repository = m::mock(CategoryRepositoryEloquent::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminCategoryController($responseFactory, $repository);    
        $this->assertInstanceOf(Controller::class, $controller); 
        
    }
    
    /*
    public function test_controller_should_run_index_method_and_return_correct_argument(){
        $repository = m::mock(CategoryRepository::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminCategoryController($responseFactory, $repository);
        $html = m::mock();
        
        $categoriesResult = ['cat1', 'cat2'];
        $repository->shouldReceive('view')
                ->with('codecategory::index', ['categories' => $categoriesResult])
                ->andReturn($html);
        
        $this->assertEquals($controller->index(), $html);
    }
    */
}

