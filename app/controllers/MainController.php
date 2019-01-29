<?php

namespace app\controllers;

use app\models\Main;
use fw\core\App;
use fw\core\base\View;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use PHPMailer\PHPMailer\PHPMailer;

class MainController extends AppController
{
//    public $layout = 'main';


    public function indexAction()
    {
        // create a log channel
        $log = new Logger('name');
        try {
            $log->pushHandler(new StreamHandler(ROOT . '/tmp/monolog.log', Logger::WARNING));
        } catch (\Exception $e) {
        }
//        var_dump($log);


        // add records to the log
        $log->warning('Foo');
        $log->error('Bar');


        /*$mailer = new PHPMailer();
        var_dump($mailer);*/

//        App::$app->getList();

//        $model = new Main();
//        $posts = App::$app->cache->get('posts');

//        if(!$posts){
            $posts = \R::findAll('posts');
//            App::$app->cache->set('posts', $posts, 3600*24);
//        }

        $menu = \R::findAll('category');

        $title = 'PAGE TITLE';
//        $this->setMeta('Home page', 'This is home page description', 'This is home page keywords');
//        $meta = $this->meta;
        View::setMeta('Home page', 'This is home page description', 'This is home page keywords');
        $this->set(compact('title', 'posts', 'menu', 'meta'));
    }

    public function testAction()
    {
        if ($this->isAjax()){
            $model = new Main();

            /*$data = ['answer' => 'Ответ с сервера', 'code' => 200];
            echo json_encode($data);*/

            $post = \R::findOne("posts", "id = {$_POST['id']}");
            $this->loadView('_test', compact('post'));
            die();
        }
        echo 222;
    }
}
