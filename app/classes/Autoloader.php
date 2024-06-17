<?php

namespace App\Classes;

class Autoloader
{

    static function autoload(string $class_name, string $dir = __DIR__)
    {
        $class_name = explode("\\", $class_name);
        $class_name = end($class_name);
        include_once($dir . "/" . $class_name . '.php');
    }

    static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }
}
