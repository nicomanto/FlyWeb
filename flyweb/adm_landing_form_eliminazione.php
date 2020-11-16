<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $page = new \html\template('board');

    $id= $_GET['par_id'];
    $travelController = new \controllers\TravelController($id);

    /*
    //print debug
    foreach ($datiViaggio as $key => $value) {
        echo "Key: $key; Value: $value\n";
    }
    */

    $titolo = $travelController->getTitle($id);

    $travelController->deleteTravel($id);


    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-FORM-INSERIMENTO-VIAGGIO', '');

    $page->replaceTag('ADM-SUCCESSO', (new \html\components\AdmSuccesso($titolo,"eliminazione") ));
    $page->replaceTag('ADM-DASHBOARD', " ");

    echo $page;
