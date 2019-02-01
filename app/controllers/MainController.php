<?php

namespace app\controllers;

use app\models\Main;
use fw\core\App;
use fw\core\base\View;
use fw\libs\Pagination;
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
//        $log->warning('Foo');
//        $log->error('Bar');


        /*$mailer = new PHPMailer();
        var_dump($mailer);*/

//        App::$app->getList();

//        $posts = App::$app->cache->get('posts');

//        if(!$posts){
//            $posts = \R::findAll('posts');
//            App::$app->cache->set('posts', $posts, 3600*24);
//        }

        $model = new Main();
        $lang = App::$app->getProperty('lang')['code'];
        $total = \R::count('posts', 'lang_code = ?', [$lang]);
//        $total = \R::count('posts');
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 2;
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $posts = \R::findAll('posts', "lang_code = ? LIMIT $start, $perpage", [$lang]);



        $menu = \R::findAll('category');

        View::setMeta('Home page', 'This is home page description', 'This is home page keywords');
        $this->set(compact('title', 'posts', 'menu', 'meta', 'pagination', 'total'));
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
