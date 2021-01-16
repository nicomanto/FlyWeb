<?php

use controllers\AdmController;
use controllers\RouteController;
use controllers\TravelController;
use html\components\AdmDashBoard;
use html\components\AdmFooter;
use html\components\AdmSuccesso;
use html\components\Breadcrumb;
use html\components\Head;
use html\Template;
use model\BreadcrumbItem;

require_once('./autoload.php');

    RouteController::protectedRoute();

    $page = new Template('board');

    $id= $_GET['par_id'];

    $travelController = new TravelController($id);
    $admController    = new AdmController;

    /*
    //print debug
    foreach ($datiViaggio as $key => $value) {
        echo "Key: $key; Value: $value\n";
    }
    */
    $titolo = $travelController->getTitle($id);
    $travelController->deleteTravel($id);


    $page->replaceTag('HEAD', (new Head));

    $page->replaceTag('ADM-MENU', (new AdmDashboard("generale")));

    $breadcrumb=array(
        new BreadcrumbItem("./index.php","Pannello di amministrazione"),
        new BreadcrumbItem("./adm_search.php","Ricerca viaggi"),
        new BreadcrumbItem("#","Eliminazione viaggio")
    );
    
    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    $page->replaceTag('ADM-CONTENUTO', (new AdmSuccesso($titolo,"eliminazione") ));

    $page->replaceTag('PAGE-SELECTOR', ""));

    $page->replaceTag('ADM-FOOTER', (new AdmFooter()));

    echo $page;
