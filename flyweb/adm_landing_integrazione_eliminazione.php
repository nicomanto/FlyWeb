<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $page = new \html\template('board');

    $id= $_GET['par_id'];

    $integrazioneController = new \controllers\IntegrazioneController($id);

    $integrazione = ($integrazioneController->integrazione);
    $t = $integrazione->nome;

    $integrazioneController->deleteIntegrazione($id);

    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard));

    $page->replaceTag('ADM-CONTENUTO', (new \html\components\AdmSuccesso($t,"eliminazione") ));

    $page->replaceTag('ADM-LIST','');

    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;
