<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use CodePress\CodeCategory\Models\Category;
use CodePress\CodePosts\Models\Comment;
use CodePress\CodePosts\Models\Post;
use CodePress\CodeTag\Models\Tag;
use CodePress\CodeUser\Models\User;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => 'user',
        'email' => 'user@email',
        'password' => bcrypt(123456),
        'remember_token' => str_random(10)
    ];
});

$factory->define(Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'active' => true
    ];
});

$factory->define(Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->title,
        'content' => $faker->paragraph
    ];
});

$factory->define(Comment::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->paragraph
    ];
});


