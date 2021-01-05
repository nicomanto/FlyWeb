<?php
    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();

    $page = new \html\template('board');

    $id= $_GET['par_id'];

    $travelController = new \controllers\TravelController($id);
    $admController    = new \controllers\AdmController;

    /*
    //print debug
    foreach ($datiViaggio as $key => $value) {
        echo "Key: $key; Value: $value\n";
    }
    */
    $titolo = $travelController->getTitle($id);
    $travelController->deleteTravel($id);


    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("generale")));

    $breadcrumb=array(
        new model\BreadcrumbItem("/admin/index.php","Pannello di amministrazione"),
        new model\BreadcrumbItem("/admin/search.php","Ricerca viaggi"),
    );
    
    $page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    $page->replaceTag('ADM-CONTENUTO', (new \html\components\AdmSuccesso($titolo,"eliminazione") ));

    $page->replaceTag('ADM-FOOTER', (new \html\components\AdmFooter()));

    echo $page;
