<?php
    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();

    $page = new Template('board');

    $id= $_GET['par_id'];

    $travelController = new TravelController($id);
    $admController    = new \controllers\AdmController;

    /*
    //print debug
    foreach ($datiViaggio as $key => $value) {
        echo "Key: $key; Value: $value\n";
    }
    */
    $titolo = $travelController->getTitle($id);
    $travelController->deleteTravel($id);


    $page->replaceTag('HEAD', (new Head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("generale")));

    $breadcrumb=array(
        new BreadcrumbItem("/admin/index.php","Pannello di amministrazione"),
        new BreadcrumbItem("/admin/search.php","Ricerca viaggi"),
    );
    
    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    $page->replaceTag('ADM-CONTENUTO', (new \html\components\AdmSuccesso($titolo,"eliminazione") ));

    $page->replaceTag('ADM-FOOTER', (new \html\components\AdmFooter()));

    echo $page;
