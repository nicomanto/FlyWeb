<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');
    session_unset();
    header('location:index.php');


    $admController = new \controllers\AdmController();
    $nome = $_COOKIE['flw_user'];
    $id=$admController->getIDFromUsername($nome);
    $userController= new \controllers\UserController($id['ID_Utente']);

    $userController->deleteUser($id['ID_Utente']);


    exit();

