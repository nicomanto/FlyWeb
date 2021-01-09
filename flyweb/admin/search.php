<?php
    use controllers\RouteController;
    use html\components\AdmFooter;


    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();


    $page = new Template('board');

    // Set page head
    $page->replaceTag('HEAD', (new Head));

    // Set nav menu
    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard));

    $breadcrumb=array(
        new BreadcrumbItem("/admin/index.php","Pannello di amministrazione"),
        new BreadcrumbItem("/admin/search.php","Ricerca viaggi"),
    );

    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));


    // Set search box form
    $page->replaceTag('ADM-CONTENUTO', (new SearchBox("adm-searchbox")));

    $page->replaceTag('ADM-FOOTER', new AdmFooter());


    echo $page;