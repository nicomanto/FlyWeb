<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $page = new \html\template('board');

    $id= $_GET['par_id'];
    $travelController = new \controllers\TravelController((int)$id);

    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));
    
    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard));
    
    $page->replaceTag('ADM-CONTENUTO', (new \html\components\FormViaggio($travelController->travel)));

    $page->replaceTag('ADM-LIST','');

    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;