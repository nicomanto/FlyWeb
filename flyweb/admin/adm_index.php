<?php
    use controllers\RouteController;
    use html\components\AdmDashBoard;
    use html\components\AdmFooter;
    use html\components\AdmInfoHome;
    use html\components\Breadcrumb;
    use html\components\Head;
    use html\Template;
    use model\BreadcrumbItem;

    require_once('../autoload.php');

    // This route can be accessed only by admins
    RouteController::protectedRoute();

    


    $page = new Template('board');


    $page->replaceTag('HEAD', (new Head));

    $page->replaceTag('ADM-MENU', (new AdmDashboard));

    $breadcrumb=array(
        new BreadcrumbItem("./index.php","Pannello di amministrazione")
    );

    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    $page->replaceTag('ADM-CONTENUTO', new AdmInfoHome());

    $page->replaceTag('ADM-FOOTER', new AdmFooter());

    echo $page;