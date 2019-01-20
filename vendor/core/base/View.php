<?php

namespace vendor\core\base;


class View
{
    /**
     * Current route and params (controller, action, params)
     * @var array
     */
    public $route = [];

    /**
     * Current view
     * @var string
     */
    public $view;

    /**
     * Current layout
     * @var string
     */
    public $layout;

    public $scripts = [];

    public function __construct($route, $layout = '', $view = '')
    {
        $this->route = $route;

        if(false === $layout) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }

        $this->view = $view;
    }

    public function render($vars)
    {
        if(is_array($vars)) {
            extract($vars);
        }

        $file_view = APP . "/views/{$this->route['controller']}/{$this->view}.php";

        ob_start();

        if(file_exists($file_view)) {
            require_once $file_view;
        } else {
            echo "<p>View file <b>$file_view</b> is not found ...</p>";
        }

        $content = ob_get_clean();

        if(false !== $this->layout) {
            $file_layout = APP . "/views/layouts/$this->layout.php";

            if(file_exists($file_layout)) {
                $content = $this->getScripts($content);
                $scripts = [];
                if(!empty($this->scripts[0])) {
                    $scripts = $this->scripts[0];
                }
                require_once $file_layout;
            } else {
                echo "<p>Layout file <b>$file_layout</b> is not found ...</p>";
            }
        }
    }

    protected function getScripts($content)
    {
        $pattern = "#<script.*?>.*?</script>#si";
        preg_match_all($pattern, $content, $this->scripts);
        if(!empty($this->scripts)) {
            $content = preg_replace($pattern, '', $content);
        }
        return $content;
    }
}
