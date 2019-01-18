<?php

$config = [
    'components' => [
        'cache' => 'classes\Cache',
        'test' => 'classes\Test',
    ],
];

spl_autoload_register(function ($class) {
    $file = str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

class Registry
{
    public static $objects = [];

    protected static $instance;

    protected function __construct()
    {
        global $config;

        foreach ($config['components'] as $name => $component) {
            self::$objects[$name] = new $component;
        }
    }

    public static function instance()
    {
        if(null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __get($name)
    {
        if(is_object(self::$objects[$name])) {
            return self::$objects[$name];
        }
    }

    public function __set($name, $object)
    {
        if(!isset(self::$objects[$name])) {
            self::$objects[$name] = new $object;
        }
    }

    public function getList()
    {
        var_dump(self::$objects);
    }
}

$app = Registry::instance(); /*var_dump($app->test);*/

$app->test->go();

$app->test2 = 'classes\Test2';
$app->getList();

$app->test2->hello();
