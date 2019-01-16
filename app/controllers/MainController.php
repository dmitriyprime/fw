<?php

namespace app\controllers;


use app\models\Main;

class MainController extends AppController
{
//    public $layout = 'main';


    public function indexAction()
    {
        $model = new Main();

//        $res = $model->query("CREATE TABLE fw.posts SELECT * FROM mage227ce.cms_page");
        $posts = $model->findAll();
//        $post = $model->findOne('Enable Cookies', 'title');
//        $data = $model->findBySql("SELECT * FROM $model->table ORDER BY page_id DESC LIMIT 2");
//        $data = $model->findBySql("SELECT * FROM `$model->table` WHERE `title` LIKE ?", ['%Cook%']);
//        $data = $model->findLike('Cook', 'title');



        $title = 'PAGE TITLE';
        $this->set(compact('title', 'posts'));
    }
}
