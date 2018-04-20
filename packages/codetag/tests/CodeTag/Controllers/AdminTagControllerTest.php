<?php
namespace CodePress\CodeTag\Tests\Controllers;
 
use CodePress\CodeTag\Controllers\Controller;
use CodePress\CodeTag\Controllers\AdminTagController;
use CodePress\CodeTag\Tests\AbstractTestCase;
use CodePress\CodeTag\Repository\TagRepository;
use Illuminate\Contracts\Routing\ResponseFactory;

use Mockery as m;
 
class AdminTagControllerTest extends AbstractTestCase
{
 
    public function test_should_extend_from_controller(){
        $responseFactory = m::mock(ResponseFactory::class);
        $repository = m::mock(TagRepository::class);
        $controller = new AdminTagController($responseFactory, $repository);
        
        $this->assertInstanceOf(Controller::class, $controller);
    }
    
     public function test_controller_should_run_index_method_and_return_correct_argument(){
         
        $responseFactory = m::mock(ResponseFactory::class);
        $repository = m::mock(TagRepository::class);
        $controller = new AdminTagController($responseFactory, $repository);
        $html = m::mock();
        
        $tagsResult = ['tag1', 'tag2'];
        $repository->shouldReceive('all')->andReturn($tagsResult);
        $responseFactory->shouldReceive('view')
                ->with('codetag::index', ['tags' => $tagsResult]) //parâmetros obrigatórios
                ->andReturn($html); // objeto qualquer
        
        $this->assertEquals($controller->index(), $html);
    }
 
}


