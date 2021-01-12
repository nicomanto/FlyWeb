<?php

    use controllers\IntegrazioneController;
    use controllers\RouteController;
    use html\components\AdmDashBoard;
    use html\components\AdmFormIntegrazione;
    use html\components\Head;
    use html\Template;

    require_once('../autoload.php');

    RouteController::protectedRoute();

    $page = new Template('board');
    $id=$_GET['par_id'];
    $integrazioneContorller = (new IntegrazioneController((int)$id));


    // Set page head
    $page->replaceTag('HEAD', (new Head));

    $page->replaceTag('ADM-MENU', (new AdmDashboard("integrazione_modifica")));

    $page->replaceTag('ADM-CONTENUTO', (new AdmFormIntegrazione($integrazioneContorller->integrazione)));

    echo $page;