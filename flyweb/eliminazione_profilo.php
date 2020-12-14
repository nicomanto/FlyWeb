<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $admController = new \controllers\AdmController();
    $userController= new \controllers\UserController();

    $userController->deleteUser();

    session_unset();
    header('location:index.php');

    exit();

