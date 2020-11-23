<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $page = new \html\template('board');

    echo $page;

    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));

    // Set nav menu
    //$page->replaceTag('ADM-NAV-MENU', (new \html\components\NavMenu));

    $id=$_GET['par_id'];
    //echo "! ID |".$id;
    $integrazioneContorller = (new \controllers\IntegrazioneController((int)$id));
    
    //$travelController->deleteTravel();
    $page->replaceTag('ADM-FORM-INSERIMENTO-VIAGGIO', '');
    $page->replaceTag('ADM-SUCCESSO', '');
    $page->replaceTag('ADM-DASHBOARD', '');
    $page->replaceTag('ADM-REVIEWS', '');

    $page->replaceTag('ADM-FORM-INSERIMENTO-INTEGRAZIONE', (new \html\components\AdmFormIntegrazione($integrazioneContorller->integrazione)));

    echo $page;