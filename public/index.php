<?php

echo $query = $_SERVER['QUERY_STRING'] . '<br>';

require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';

Router::add('posts/add', ['controller' => 'Posts', 'action' => 'add']);
Router::add('posts/', ['controller' => 'Posts', 'action' => 'index']);
Router::add('', ['controller' => 'Main', 'action' => 'index']);

var_dump(Router::getRoutes());

if(Router::matchRoute($query)) {
    debug(Router::getRoute());
} else {
    echo '404 Not found';
}
