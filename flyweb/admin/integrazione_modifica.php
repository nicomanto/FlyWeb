<?php

    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();

    $page = new Template('board');
    $id=$_GET['par_id'];
    $integrazioneContorller = (new \controllers\IntegrazioneController((int)$id));


    // Set page head
    $page->replaceTag('HEAD', (new Head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("integrazione_modifica")));

    $page->replaceTag('ADM-CONTENUTO', (new \html\components\AdmFormIntegrazione($integrazioneContorller->integrazione)));

    echo $page;