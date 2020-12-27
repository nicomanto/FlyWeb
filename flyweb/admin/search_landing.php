<?php

    use model\Paginator;
    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();


    // Load request's data
    extract($_GET, EXTR_SKIP);

    // Set pagination to page 1 if not specified differently
    $count = isset($page) ? $page : 1;

    if (!isset($search)) {
        // TODO: manage this situation
        header('location:/index.php');
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

    // Loading search result template
    $page= new \html\template('board');
    
    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));

    // Set nav menu
    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("generale")));

    $page->replaceValue('TITOLO', "MODIFICA O ELIMINA UN VIAGGIO");

    
    // Set search result travels
    if(empty($travels)){
        $page->replaceTag('ADM-CONTENUTO', 
            (new \html\components\searchBox("adm-searchbox")).
            "<h2>Nessun viaggio corrisponde alla ricerca</h2>");
    }
    else{
        // Paginate travels result
        $paginatedTravels = Paginator::paginate($travels, $count);
        foreach ($paginatedTravels['elements'] as $element) {
            $searchResults.= new \html\components\AdmTravelListItem($element);
        }
        
        $page->replaceTag('ADM-CONTENUTO',
            (new \html\components\searchBox("adm-searchbox")).
            "<ul>".$searchResults."</ul>".
            (new \html\components\pageSelector($paginatedTravels)));
    }
    echo $page;