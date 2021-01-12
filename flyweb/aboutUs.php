<?php

    use controllers\RouteController;
    use html\components\Breadcrumb;
    use html\components\Footer;
    use html\components\Head;
    use html\components\PrincipalMenu;
    use html\Template;
    use model\BreadcrumbItem;

    require_once('./autoload.php');

    RouteController::unprotectedRoute();


    $page = new Template('aboutUs');

    // Set page head
    $page->replaceTag('HEAD', (new Head));

    // Set breadcrumb
    $breadcrumb=array(
        new BreadcrumbItem("#","About us","en")
    );

    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    // Set nav menu
    $page->replaceTag('NAV-MENU', (new PrincipalMenu));

    // Set footer
    $page->replaceTag('FOOTER', (new Footer));

    echo $page;