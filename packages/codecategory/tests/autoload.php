<?php 

require __DIR__ . '/../vendor/autoload.php';

$loader = new Composer\Autoload\ClassLoader();

$loader->addPsr4('CodePress\\CodePosts\\', __DIR__ . '/../../codeposts/src/CodePosts');

$loader->register();

?>