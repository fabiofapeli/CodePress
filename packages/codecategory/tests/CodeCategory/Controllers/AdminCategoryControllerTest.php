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
         
        $responseFactory = m::mock(ResponseFactory::class);
        $category = m::mock(Category::class);
        $controller = new AdminCategoryController($responseFactory, $category);
        $html = m::mock();
        
        $categoriesResult = ['cat1', 'cat2'];
        $category->shouldReceive('all')->andReturn($categoriesResult);
        $responseFactory->shouldReceive('view')
                ->with('codecategory::index', ['categories' => $categoriesResult]) //parâmetros obrigatórios
                ->andReturn($html); // objeto qualquer
        
        $this->assertEquals($controller->index(), $html);
    }
     */
    
    
}

