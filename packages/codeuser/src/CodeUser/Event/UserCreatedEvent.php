<?php

namespace CodePress\CodeUser\Event;

class UserCreatedEvent{

	private $user;
	private $plainPassword;

	public function __construct($user, $plainPassword)
	{
		$this->user = $user;
		$this->plainPassword = $plainPassword;
	}

	public function getUser(){
		return $this->user;
	}

	public function setUser($user){
		$this->user = $user;
		return $this;
	}

	public function getPlainPassword(){
		return $this->plainPassword;
	}

	public function setPlainPassword($plainPassword){
		$this->plainPassword = $plainPassword;
		return $this;
	}

}