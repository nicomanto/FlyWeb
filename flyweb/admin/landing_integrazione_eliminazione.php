<?php
    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();

    $page = new Template('board');

    $id= $_GET['par_id'];

    $integrazioneController = new \controllers\IntegrazioneController($id);

    $integrazione = ($integrazioneController->integrazione);
    $t = $integrazione->nome;

    $integrazioneController->deleteIntegrazione($id);

    $page->replaceTag('HEAD', (new Head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("generale")));

    $page->replaceTag('ADM-CONTENUTO', (new \html\components\AdmSuccesso($t,"eliminazione") ));

    echo $page;
