<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $page = new \html\template('board');

    $id= $_GET['par_id'];

    $integrazioneController = new \controllers\Integrazione($id);

    $titolo = $integrazioneController->integrazione['nome'];

    $integrazioneController->deleteIntegrazione($id);

    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-FORM-INSERIMENTO-VIAGGIO', '');

    $page->replaceTag('ADM-SUCCESSO', (new \html\components\AdmSuccesso($titolo,"eliminazione") ));
    $page->replaceTag('ADM-DASHBOARD', '');
    $page->replaceTag('ADM-REVIEWS', '');
    $page->replaceTag('ADM-FORM-INSERIMENTO-INTEGRAZIONE', '');

    echo $page;
