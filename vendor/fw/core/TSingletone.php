<?php

namespace fw\core;


trait TSingletone
{
    protected static $instance;

    public static function instance()
    {
        if(null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
