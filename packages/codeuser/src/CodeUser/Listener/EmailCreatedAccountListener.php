<?php

namespace CodePress\CodeUser\Listener;

use CodePress\CodeUser\Event\UserCreatedEvent;
use Illuminate\Mail\Mailer;

class EmailCreatedAccountListener
{
	private $mailer;

	public function __construct(Mailer $mailer)
	{
		$this->mailer = $mailer;
	}


	public function handle(UserCreatedEvent $event){
		$user = $event->getUser();
		$plainPassword = $event->getPlainPassword();
		//retorna a quantidade de emails enviados
		return $this->mailer->send('email.registration',
			[
				'username' => $user->email,
				'password' => $plainPassword
			], function ($message) use($user){
				$message->to($user->email, $user->name)
						->subject("{$user->name}, sua conta foi criada!");
			}
		);
	}
}
