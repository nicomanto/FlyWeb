<?php
    use model\BreadcrumbItem;

    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Load request's data
    extract($_GET, EXTR_SKIP);
    $admController = new \controllers\AdmController();
    $userController= new \controllers\UserController();

    $page = new \html\template('modifica_info_profilo');

    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    $breadcrumb=array(
        new model\BreadcrumbItem("/datipersonali.php","Profilo"),
        new model\BreadcrumbItem("#","Modifica profilo")
    );

    $page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    $page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));
  
    $page->replaceTag('MODIFICA-INFO', (new \html\components\modificainfoprofilo($userController->user)));
    
    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;


