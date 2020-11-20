<?php
    // Start session
    session_start();

    // Register autoload function
    spl_autoload_register(function ($className) {
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        require_once($className . '.php');
    });
