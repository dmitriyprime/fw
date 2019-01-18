<?php

namespace vendor\core\base;


abstract class Controller
{

    /**
     * Current route and params (controller, action, params)
     * @var array
     */
    public $route = [];

    /**
     * View
     * @var string
     */
    public $view;

    /**
     * Current layout
     * @var string
     */
    public $layout;

    /**
     * User data
     * @var array
     */
    public $vars = [];

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $route['action'];
    }

    public function getView()
    {
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->vars);
    }

    public function set($vars)
    {
        $this->vars = $vars;
    }
}