<?php

use controllers\RouteController;
use controllers\UserController;

    require_once('./autoload.php');
    RouteController::loggedRoute();
    
    $userController= new UserController();
    $userController->deleteUser();

    session_unset();
    header('location:index.php');

    exit();

