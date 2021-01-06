<?php

    use model\Paginator;
    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();

    // Load request's data
    extract($_GET, EXTR_SKIP);

    // Set pagination to page 1 if not specified differently
    $page = isset($page) ? $page : 1;

    $integrazioneContorller = (new \controllers\IntegrazioneController());
    $integrazioni = $integrazioneContorller->getAllIntegrazioni();

    // Paginate travels result
    $paginatedIntegrazioni = Paginator::paginate($integrazioni, $page);

    // Loading search result template
    $page= new \html\template('board');

    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("gestisci_integrazioni")));

    
        
    // Set search result travels 
    //DOPO aggiunta d'integrazioni (VEDERE LISTA VIAGGI)
    //$page->replaceTag('ADM-CONTENUTO', (new \html\components\AdmContainerList($paginatedIntegrazioni,"LISTA INTEGRAZIONI")));
    $page->replaceTag('ADM-CONTENUTO', '<h1 class="adm-titolo">CERCA INTEGRAZIONI DA MODIFICARE O ELIMINARE</h1>');

    echo $page;