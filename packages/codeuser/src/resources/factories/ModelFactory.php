<?php 

use CodePress\CodeUser\Models\User;


$factory->define(User::class, function (Faker\Generator $faker){

		return [

			'name' => 'user',
			'email' => 'user@email',
			'password' => bcrypt(123456),
			'remember_token' => str_random(10)

		];

	}
);

