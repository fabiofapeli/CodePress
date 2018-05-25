<?php

namespace CodePress\CodeUser\Listener;

class TestEventListener{

	public function numero1(){
		echo "numero 1";
	}

	public function numero2(){
		echo "numero 2";
	}

	public function subscribe($events){
		//Dois listener para um evento
		$events->listen('event.numero1', 'CodePress\CodeUser\Listener\TestEventListener@numero1', 5);
		$events->listen('event.numero1', 'CodePress\CodeUser\Listener\TestEventListener@numero2', 9);
	}

}
