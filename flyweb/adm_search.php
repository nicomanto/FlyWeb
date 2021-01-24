<?php
    use controllers\RouteController;
    use html\components\AdmDashBoard;
    use html\components\AdmFooter;
    use html\components\Breadcrumb;
    use html\components\Head;
    use html\components\SearchBox;
    use html\Template;
    use model\BreadcrumbItem;

    require_once('./autoload.php');

    RouteController::protectedRoute();


    $page = new Template('board');

    // Set page head
    $page->replaceTag('HEAD', (new Head));

    // Set nav menu
    $page->replaceTag('ADM-MENU', (new AdmDashboard));

    $breadcrumb=array(
        new BreadcrumbItem("./index.php","Pannello di amministrazione"),
        new BreadcrumbItem("#","Ricerca viaggi"),
    );

    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));


    // Set search box form
    $page->replaceTag('ADM-CONTENUTO', (new SearchBox("searchbox")));
    
    $page->replaceTag('PAGE-SELECTOR', '');

    $page->replaceTag('ADM-FOOTER', new AdmFooter());

    echo $page;