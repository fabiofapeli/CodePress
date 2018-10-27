<?php
namespace CodePress\CodeUser\Tests;

use CodePress\CodeUser\Providers\CodeUserServiceProvider;
use Illuminate\Auth\AuthServiceProvider;
use Illuminate\Auth\Passwords\PasswordResetServiceProvider;
use Orchestra\Testbench\TestCase;

abstract class AbstractTestCase extends TestCase
{

    public function migrate(){
        $this->artisan(
            'migrate:refresh' // exclui o banco de dados e cria novamente
            ,[
            '--realpath' => realpath(__DIR__."/../src/resources/migrations")
        ]);
    }

    protected function getEnvironmentSetUp($app)
    {
        /*
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        */

        config(['database' => require __DIR__ . '/config/database.php']);

        config(['auth' => require __DIR__ . '/../src/config/auth.php']); // pode ser usado também $app['config']
    }

    public function getPackageProviders($app)
    {
        return [
            AuthServiceProvider::class,
            PasswordResetServiceProvider::class,
            CodeUserServiceProvider::class
        ];
    }

}
