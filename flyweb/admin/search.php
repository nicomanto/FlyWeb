<?php
    use controllers\RouteController;
    use html\components\AdmFooter;


    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();


    $page = new \html\template('board');

    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));

    // Set nav menu
    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard));

    $breadcrumb=array(
        new model\BreadcrumbItem("/admin/index.php","Pannello di gestione"),
        new model\BreadcrumbItem("/admin/search.php","Ricerca viaggi"),
    );

    $page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));


    // Set search box form
    $page->replaceTag('ADM-CONTENUTO', (new \html\components\searchBox("adm-searchbox")));

    $page->replaceTag('ADM-FOOTER', new AdmFooter());


    echo $page;