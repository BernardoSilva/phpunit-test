<?php

function my_autoloader($class)
{

    if (file_exists('models/' . $class . '.php')) {
        include_once 'models/' . $class . '.php';
    } elseif (file_exists('tests/Mocs/' . $class . '.php')) {
        include_once 'tests/Mocs/' . $class . '.php';
    }
}

spl_autoload_register('my_autoloader');