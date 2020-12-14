<?php
    // Start session
    session_start();

    // Register autoload function
    spl_autoload_register(function ($className) {
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        require_once($className . '.php');
    });

    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
