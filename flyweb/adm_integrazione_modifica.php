<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $page = new \html\template('board');
    $id=$_GET['par_id'];
    $integrazioneContorller = (new \controllers\IntegrazioneController((int)$id));


    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard));

    $page->replaceTag('ADM-CONTENUTO', (new \html\components\AdmFormIntegrazione($integrazioneContorller->integrazione)));

    $page->replaceTag('ADM-LIST','');

    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;