<?php

function my_loader($class)
{
    include 'models/' . $class . '.php';
}

spl_autoload_register('my_loader');