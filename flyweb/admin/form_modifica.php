<?php

    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();

    $page = new \html\template('board');

    $id= $_GET['par_id'];
    $travelController = new \controllers\TravelController((int)$id);

    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));
    
    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("modifica_viaggio")));

    $breadcrumb=array(
        new model\BreadcrumbItem("/admin/index.php","Pannello di amministrazione"),
        new model\BreadcrumbItem("/admin/search.php","Ricerca viaggi"),
        new model\BreadcrumbItem("/admin/form_modifica.php","Modifica viaggio")
    );
    $page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));
    
    $page->replaceTag('ADM-CONTENUTO', (new \html\components\FormViaggio($travelController->travel,$travelController->getIdTag())));

    $page->replaceTag('ADM-FOOTER', (new \html\components\AdmFooter()));

    echo $page;