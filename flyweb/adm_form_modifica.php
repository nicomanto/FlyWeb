<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $page = new \html\template('board');

    echo $page;

    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));

    // Set nav menu
    //$page->replaceTag('ADM-NAV-MENU', (new \html\components\NavMenu));

    $id= $_GET['par_id'];
    //echo "! ID |".$id;
    $travelController = new \controllers\TravelController((int)$id);
    
    //$travelController->deleteTravel();
    $page->replaceTag('ADM-FORM-INSERIMENTO-VIAGGIO', (new \html\components\FormViaggio($travelController->travel)));
    $page->replaceTag('ADM-SUCCESSO', " ");
    $page->replaceTag('ADM-DASHBOARD', " ");

    echo $page;