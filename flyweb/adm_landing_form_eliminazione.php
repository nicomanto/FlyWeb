<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $page = new \html\template('board');

    $id= $_GET['par_id'];

    $integrazioneController = new \controllers\TravelController($id);
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

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard));

    $page->replaceTag('ADM-CONTENUTO', (new \html\components\AdmSuccesso($titolo,"eliminazione") ));
    
    $page->replaceTag('ADM-LIST','');

    $page->replaceTag('FOOTER', (new \html\components\footer));


    echo $page;
