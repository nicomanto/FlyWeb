<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Load request's data
    extract($_GET, EXTR_SKIP);
    $admController = new \controllers\AdmController();
    $nome = $_COOKIE['flw_user'];
    $id=$admController->getIDFromUsername($nome);
    $userController= new \controllers\UserController($id['ID_Utente']);

    $page = new \html\template('profilo');

    $page->replaceTag('HEAD', (new \html\components\head));
    
    $page->replaceTag('NAV-MENU', (new \html\components\NavMenu));

    $page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));
  
    $page->replaceTag('DATIPERSONALI', (new \html\components\datiPersonali($userController->user)));

    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;