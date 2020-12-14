<?php
    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();

    $page = new \html\template('board');

    $id= $_GET['par_id'];

    $integrazioneController = new \controllers\IntegrazioneController($id);

    $integrazione = ($integrazioneController->integrazione);
    $t = $integrazione->nome;

    $integrazioneController->deleteIntegrazione($id);

    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("generale")));

    $page->replaceTag('ADM-CONTENUTO', (new \html\components\AdmSuccesso($t,"eliminazione") ));

    echo $page;
