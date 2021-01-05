<?php
    use model\BreadcrumbItem;
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Load request's data
    extract($_GET, EXTR_SKIP);
    $userController= new \controllers\UserController();

    $page = new \html\template('profilo');

    $page->replaceTag('HEAD', (new \html\components\head));
    
    $page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new model\BreadcrumbItem("#","Profilo")
    );

    $page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    $page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));
  
    $page->replaceTag('DATIPERSONALI', (new \html\components\datiPersonali($userController->user)));

    $page->replaceTag('ORDINI-PROFILO', '');

    $page->replaceTag('RECENSIONI-PROFILO', '');

    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;