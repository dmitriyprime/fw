<?php


namespace app\controllers\admin;

use vendor\core\base\View;


class UserController extends AppController
{
    public $layout = 'default';

    public function indexAction()
    {
        View::setMeta('Admin panel :: Main page', 'Admin panel description', '');

        $test = 'test variable';
        $data = ['test', 2];

        /*$this->set([
            'test' => $test,
            'data' => $data,
        ]);*/

        $this->set(compact('test', 'data'));
    }

    public function testAction()
    {
        $this->layout = 'admin';
    }
}
