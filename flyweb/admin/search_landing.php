<?php

    use model\Paginator;
    use controllers\RouteController;
    use controllers\SearchController;
    use html\components\AdmDashBoard;
    use html\components\AdmFooter;
    use html\components\AdmTravelListItem;
    use html\components\Breadcrumb;
    use html\components\Head;
    use html\components\PageSelector;
    use html\components\ResponseMessage;
    use html\Template;
    use model\BreadcrumbItem;

    require_once('../autoload.php');

    RouteController::protectedRoute();


    // Load request's data
    extract($_GET, EXTR_SKIP);

    // Set pagination to page 1 if not specified differently
    $count = isset($page) ? $page : 1;

    if (!isset($search_button)) {
        // TODO: manage this situation
        header('location:/index.php');
        exit();
    }

    $searchController = new SearchController();

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
    $page= new Template('board');
    
    // Set page head
    $page->replaceTag('HEAD', (new Head));

    // Set nav menu
    $page->replaceTag('ADM-MENU', (new AdmDashboard("inserisci_viaggio")));

    $breadcrumb=array(
        new BreadcrumbItem("./index.php","Pannello di gestione"),
        new BreadcrumbItem("./search.php","Ricerca viaggi"),
        new BreadcrumbItem("./search_landing.php","Risultati ricerca viaggi")
    );

    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    
    // Set search result travels
    if(empty($travels)){
        $page->replaceTag('ADM-CONTENUTO', new responseMessage("Nessun viaggio..."));
    }
    else{
        // Paginate travels result
        $paginatedTravels = Paginator::paginate($travels, $count);
        foreach ($paginatedTravels['elements'] as $element) {
            $searchResults.= new AdmTravelListItem($element);
        }
        
        $page->replaceTag('ADM-CONTENUTO',
        '<h1 class="adm-titolo">LISTA VIAGGI</h1>'."<ul>".$searchResults."</ul>".(new PageSelector($paginatedTravels)));
    }

    $page->replaceTag('ADM-FOOTER', (new AdmFooter()));

    echo $page;