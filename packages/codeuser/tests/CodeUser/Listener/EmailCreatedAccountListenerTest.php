<?php
namespace CodePress\CodeUser\Tests\EmailCreatedAccountListenerTest;

use CodePress\CodeUser\Event\UserCreatedEvent;
use CodePress\CodeUser\Models\User;
use CodePress\CodeUser\Tests\AbstractTestCase;
use Iluminate\Mail\Mailer;
use Iluminate\Mail\Message;
use Mockery as m;

class EmailCreatedAccountListenerTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_can_trigger_handle()
    {
        $mockUser           = m::mock(User::class);
        $mockUser->shouldReceive('getAttribute')->with('name')->andReturn('Teste');
        $mockUser->shouldReceive('getAttribute')->with('email')->andReturn('teste@teste.com');
        $mockUser->shouldReceive('getAttribute')->with('password')->andReturn('123456');
        
        $event = new UserCreatedEvent($mockUser, $mockUser->password);

        //Mock da classe de email
        $mockMailer = m::mock(Mailer::class);
        $mockMailer->shouldReceive('send')
            ->with('email.registration', [
                'username' => $mockUser->email,
                'password' => $mockUser->password,
            ],
                //passando como parâmetro uma função
                m::on(function (\Closure $closure) use ($mockUser) {
                    $mockMessage = m::mock(Message::class);
                    $mockMessage->shouldReceive('to')
                        ->with($mockUser->email, $mockUser->password)
                        ->andReturn($mockMessage);
                    $mockMessage->shouldReceive('subject')
                        ->with("{$mockUser->name}, sua conta foi criada!");
                    $closure($mockMessage);
                }
                )
            //retorno é a quantidade de emails enviados
            )->andReturn(1);

        $listener = new EmailCreatedAccountListener($mockMailer);
        $result = $listener->handle($event);
        $this->assertEquals(1, $result);
    }

}
