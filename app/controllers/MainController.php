<?php

namespace app\controllers;

use app\models\Main;
use vendor\core\App;


class MainController extends AppController
{
//    public $layout = 'main';


    public function indexAction()
    {
//        App::$app->getList();

//        $model = new Main();

//        $posts = App::$app->cache->get('posts');

//        if(!$posts){
            $posts = \R::findAll('posts');
//            App::$app->cache->set('posts', $posts, 3600*24);
//        }

        $menu = \R::findAll('category');

        $title = 'PAGE TITLE';
        $this->setMeta('Home page', 'This is home page description', 'This is home page keywords');
        $meta = $this->meta;
        $this->set(compact('title', 'posts', 'menu', 'meta'));
    }

    public function testAction()
    {
        if ($this->isAjax()){
            echo 'AJAX';
            die();
        }
        echo 222;
        $this->layout = 'test';
        $this->setMeta('Home page', 'This is home page description', 'This is home page keywords');
        $meta = $this->meta;
        $this->set(compact('meta'));
    }
}
