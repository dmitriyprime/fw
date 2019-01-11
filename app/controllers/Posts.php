<?php

namespace app\controllers;

use vendor\core\base\Controller;

class Posts extends Controller
{

    public function indexAction()
    {
        echo 'Posts::index()';
    }

    public function testAction()
    {
        var_dump($this->route);
        echo 'Posts::test()';
    }
}
