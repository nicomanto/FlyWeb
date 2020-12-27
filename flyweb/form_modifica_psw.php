<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Load request's data
    extract($_GET, EXTR_SKIP);
    $admController = new \controllers\AdmController();
    $userController= new \controllers\UserController();
 
    $page = new \html\template('modifica_info_profilo');

    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    $page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));
  
    $page->replaceTag('MODIFICA-PSW', (new \html\components\formModificaPsw($userController->user)));

    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;