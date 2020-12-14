<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Load request's data
    extract($_GET, EXTR_SKIP);
    $admController = new \controllers\AdmController();
    $userController= new \controllers\UserController();

    $page = new \html\template('profilo');

    $page->replaceTag('HEAD', (new \html\components\head));
    
    $page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    $page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));
  
    $page->replaceTag('DATIPERSONALI', (new \html\components\datiPersonali($userController->user)));

    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;