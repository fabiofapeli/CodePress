<?php
namespace CodePress\CodeUser\Tests;

require __DIR__  . '/AbstractTestCase.php';

//Extender da classe principal AbstractTestCase
abstract class AbstractMailTestCase extends AbstractTestCase
{

    /*
    Método será executado antes de qualquer outro
    pasta views será criada uma única vez e não há cada teste
    */
    public static function setUpBeforeClass()
    {
        //excluir a pasta views se já tiver, evitando que o laravel pegue arquivos que estão no cache
        self::rrmdir(__DIR__ . '/views');
        //criar pasta views (por padrão cria com permissão total 0777)
        mkdir(__DIR__ . '/views');
    }

    /*
    Ao termnar todos o testes matar pasta view
    */
    public static function tearDownAfterClass()
    {
        self::rrmdir(__DIR__ . '/views');
    }

    /*
    Método para excluir arquivos antes de excluir pasta
    */
    public static function rrmdir($dir) {
        if (is_dir($dir))
        {
            $objects = scandir($dir);
            foreach ($objects as $object)
            {
                if ($object != "." && $object != "..")
                {
                    if (filetype($dir . "/" . $object) == "dir")
                    {
                        self::rrmdir($dir . "/" . $object);
                    } else
                    {
                        unlink($dir . "/" . $object);
                    }
                }
            }
            rmdir($dir);
        }
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);
        //configurações de ambiente para testes de email
        config([
            'app' => [
                //criar chave com 32 caracteres
                'key' => '12345678912345678912345678912345',
                //copiado de config/app.php (não trabalhar com .env)
                'cipher' => 'AES-256-CBC'
                ]
            ]
        );
        config(
            ['mail' => require __DIR__ . '/config/mail.php']
        );
        config(
            ['view' => require __DIR__ . '/config/view.php']
        );
    }

    /*
    Incluir provider responsável pelo serviço de email
    */
    public function getPackageProviders($app)
    {
       $array = parent::getPackageProviders($app);
        return $array + [
            MailServiceProvider::class
        ];
    }

}
