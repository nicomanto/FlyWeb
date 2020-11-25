<?php

use shared\Paginator;

require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

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

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard));


    foreach ($paginatedIntegrazioni['elements'] as $i) {
        $sr .= new \html\components\IntegrazioneListItem($i);
    }
        
    // Set search result travels
    $page->replaceTag('ADM-CONTENUTO', $sr);

    // Set pagination indicator
    $page->replaceTag('ADM-LIST', (new \html\components\pageSelector($paginatedIntegrazioni['currentPage'], $paginatedIntegrazioni['totalPages'])));
    // $_page .= "sei a pagina " . $paginatedTravels['currentPage'] . ' di ' . $paginatedTravels['totalPages'];

    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;