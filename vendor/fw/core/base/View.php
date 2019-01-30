<?php

namespace fw\core\base;


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

    public static $meta = ['title' => '', 'desc' => '', 'keywords' => ''];

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

    protected function compressPage($buffer)
    {
        $search = [
            "/(\n)+/",
            "/\r\n+/",
            "/\n(\t)+/",
            "/\n(\ )+/",
            "/\>(\n)+</",
            "/\>\r\n</",
        ];

        $replace = [
            "\n",
            "\n",
            "\n",
            "\n",
            "><",
            "><",
        ];

        return preg_replace($search, $replace, $buffer);

    }

    public function render($vars)
    {
        $this->route['prefix'] = str_replace('\\', '/', $this->route['prefix']);

        if(is_array($vars)) {
            extract($vars);
        }

        $file_view = APP . "/views/{$this->route['prefix']}{$this->route['controller']}/{$this->view}.php";

//        ob_start([$this, 'compressPage']);

//        ob_start('ob_gzhandler');
        ob_start();
        {
//            header("Content-Encoding: gzip");
            if(file_exists($file_view)) {
                require_once $file_view;
            } else {
                throw new \Exception('<p>View file <b>$file_view</b> is not found ...</p>', 404);
            }

            $content = ob_get_contents();
        }

        ob_clean();

//        $content = ob_get_clean();

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
                throw new \Exception('<p>Layout file <b>$file_layout</b> is not found ...', 404);
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

    public static function getMeta()
    {
        echo '<title>' . self::$meta['title'] . '</title>
            <meta name="description" content="' . self::$meta['desc'] . '">
            <meta name="keywords" content="' . self::$meta['keywords'] . '">';
    }
    public static function setMeta($title = '', $desc = '', $keywords = '')
    {
        self::$meta['title'] = $title;
        self::$meta['desc'] = $desc;
        self::$meta['keywords'] = $keywords;
    }

}
