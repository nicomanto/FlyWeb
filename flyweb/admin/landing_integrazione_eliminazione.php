<?php

    use controllers\IntegrazioneController;
    use controllers\RouteController;
    use html\components\AdmDashBoard;
    use html\components\AdmSuccesso;
    use html\components\Head;
    use html\Template;

    require_once('../autoload.php');

    RouteController::protectedRoute();

    $page = new Template('board');

    $id= $_GET['par_id'];

    $integrazioneController = new IntegrazioneController($id);

    $integrazione = ($integrazioneController->integrazione);
    $t = $integrazione->nome;

    $integrazioneController->deleteIntegrazione($id);

    $page->replaceTag('HEAD', (new Head));

    $page->replaceTag('ADM-MENU', (new AdmDashboard("generale")));

    $page->replaceTag('ADM-CONTENUTO', (new AdmSuccesso($t,"eliminazione") ));

    echo $page;
