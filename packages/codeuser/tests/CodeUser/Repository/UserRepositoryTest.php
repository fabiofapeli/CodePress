<?php
namespace CodePress\CodeUser\Tests\UserRepositoryTest;

use Mockery as m;
use CodePress\CodeUser\Repository\UserRepositoryEloquent;
use CodePress\CodeUser\Repository\UserRepositoryInterface;
use CodePress\CodeUser\Tests\AbstractTestCase;
use Illuminate\Support\Facades\Hash;

class UserRepositoryTest extends AbstractTestCase
{
    /**
     * @var UserRepositoryInterface
     */

	private $repository;

    public function setUp(){
        parent::setUp();
        $this->migrate();
        $this->repository = new UserRepositoryEloquent();
    }

 	public function test_can_create_user(){
 		$user = $this->repository->create([
            'name' => 'Teste',
            'email' => 'teste@teste.com',
            'password' => '123456'
        ]);

        $this->assertEquals('Teste', $user->name);
        $this->assertEquals('teste@teste.com', $user->email);
        $this->assertTrue(Hash::check('123456', $user->password));
    }


}