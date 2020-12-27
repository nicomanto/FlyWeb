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

    $page->replaceValue('TITOLO', "MODIFICA IL VIAGGIO");
    
    $page->replaceTag('ADM-CONTENUTO', (new \html\components\FormViaggio($travelController->travel,$travelController->getIdTag())));

    echo $page;