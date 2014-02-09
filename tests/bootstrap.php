<?php

function my_autoloader($class)
{

    if (file_exists('models/' . $class . '.php')) {
        include_once 'models/' . $class . '.php';
    } elseif (file_exists('tests/mocs/' . $class . '.php')) {
        include_once 'tests/mocs/' . $class . '.php';
    }
}

spl_autoload_register('my_autoloader');