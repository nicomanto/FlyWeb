<?php

    use controllers\RouteController;
    use controllers\UserController;
    use html\components\Breadcrumb;
    use html\components\DatiPersonali;
    use html\components\Footer;
    use html\components\Head;
    use html\components\PrincipalMenu;
    use html\components\ProfiloMenu;
    use html\Template;
    use model\BreadcrumbItem;

    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');
    RouteController::loggedRoute();

    // Load request's data
    extract($_GET, EXTR_SKIP);
    $userController= new UserController();

    $page = new Template('profilo');

    $page->replaceTag('HEAD', (new Head));
    
    $page->replaceTag('NAV-MENU', (new PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new BreadcrumbItem("#","Profilo")
    );

    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    $page->replaceTag('PROFILOMENU', (new ProfiloMenu));
  
    $page->replaceTag('DATIPERSONALI', (new DatiPersonali($userController->user)));

    $page->replaceTag('ORDINI-PROFILO', '');

    $page->replaceTag('RECENSIONI-PROFILO', '');

    $page->replaceTag('FOOTER', (new Footer));

    echo $page;