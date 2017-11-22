<?php
// Session
session_start();

// Constants
define('ROOT', __DIR__);
define('APP', ROOT . '/app');
define('VENDOR', ROOT . '/vendor');

// Autoload custom classes
spl_autoload_register(
    function ($class) {
        $class = str_replace('\\', '/', $class);
        include_once APP . "/{$class}.php";
    }
);

// Autoload vendor classes
require_once VENDOR . '/autoload.php';