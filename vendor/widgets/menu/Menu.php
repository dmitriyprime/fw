<?php

namespace vendor\widgets\menu;


class Menu
{
    protected $data;
    protected $tree;
    protected $menuHtml;
    protected $tpl;
    protected $container = 'ul';
    protected $table = 'categories';
    protected $cache = 3600;

    public function __construct()
    {
        $this->tpl = __DIR__ . 'menu_tpl/menu.php';
        $this->run();
    }

    protected function run()
    {
        $this->data = \R::getAssoc("SELECT * FROM `categories`");
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
    }

    protected function getTree()
    {
        $tree = [];
        $data = $this->data;

        foreach ($data as $id => &$node) {
            if (!$node['parent']) {
                $tree[$id] = &$node;
            } else {
                $data[$node['parent']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }

    protected function getMenuHtml($tree, $tab = '')
    {
        $str = '';
        foreach ($tree as $id => $category) {
            $str .= $this->catToTemplate($category, $tab, $id);
        }
        return $str;
    }

    protected function catToTemplate($category, $tab, $id)
    {
        ob_start();
        require_once $this->tpl;
        return ob_get_clean();
    }
}
