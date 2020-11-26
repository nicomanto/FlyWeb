<?php

use shared\Paginator;

require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Load request's data
    extract($_GET, EXTR_SKIP);

    // Set pagination to page 1 if not specified differently
    $page = isset($page) ? $page : 1;

    if (!isset($search)) {
        // TODO: manage this situation
        header('location:index.php');
        exit();
    }

    $searchController = new \controllers\SearchController();

    if (!isset($search_by_option)) {
        echo 'Param search_by_option is missing';
        exit();
    }


    // TODO: generalize this switch???
    switch ($search_by_option){
        case 'Citta':
            $travels = $searchController->searchByPlace($search_key, $search_start_date, $search_end_date, (int)$search_start_price, (int)$search_end_price, $search_order_by, $search_order_by_mode);
            break;
        case 'Tag':
            $travels = $searchController->searchByTag($search_key, $search_start_date, $search_end_date, (int)$search_start_price, (int)$search_end_price, $search_order_by, $search_order_by_mode);
            break;
        default:
            $travels = $searchController->searchGeneral($search_key, $search_start_date, $search_end_date, (int)$search_start_price, (int)$search_end_price, $search_order_by, $search_order_by_mode);
    }

    // Paginate travels result
    $paginatedTravels = Paginator::paginate($travels, $page);

    // Loading search result template
    $page= new \html\template('board');

    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));

    // Set nav menu
    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("generale")));

    // Build list of travels;
    $searchResults='<h1 class="adm-titolo"><strong>LISTA VIAGGI</strong></h1>';
    foreach ($paginatedTravels['elements'] as $travel) {
        $searchResults .= new \html\components\AdmTravelListItem($travel);
    }
    
    // Set search result travels
    $page->replaceTag('ADM-CONTENUTO', $searchResults);

    // Set pagination indicator
    $page->replaceTag('ADM-LIST', (new \html\components\pageSelector($paginatedTravels['currentPage'], $paginatedTravels['totalPages'])));
    // $_page .= "sei a pagina " . $paginatedTravels['currentPage'] . ' di ' . $paginatedTravels['totalPages'];

    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;