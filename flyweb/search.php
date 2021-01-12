<?php

    use controllers\RouteController;
    use controllers\SearchController;
    use model\Paginator;
    use html\components\Breadcrumb;
    use html\components\Footer;
    use html\components\Head;
    use html\components\PageSelector;
    use html\components\PrincipalMenu;
    use html\components\SearchBox;
    use html\components\TravelListItem;
    use html\Template;
    use model\BreadcrumbItem;

    require_once('./autoload.php');

    RouteController::unprotectedRoute();

    // Load request's data
    extract($_GET, EXTR_SKIP);

    // Set pagination to page 1 if not specified differently
    $page = isset($page) ? $page : 1;

    if (!isset($search_button)) {
        // TODO: manage this situation
        header('location:./index.php');
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

    // Paginate travels result
    $paginatedTravels = Paginator::paginate($travels, $page);

    // Loading search result template
    $_page= new Template('search');

    // Set page head
    $_page->replaceTag('HEAD', (new Head));

    // Set nav menu
    $_page->replaceTag('NAV-MENU', (new PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new BreadcrumbItem("./index.php","Home","en"),
        new BreadcrumbItem("#","Ricerca viaggio")
    );

    $_page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    // Set search box
    $_page->replaceTag('SEARCH_BOX', (new SearchBox("searchbox")));

    // Build list of travels;
    $searchResults = '';
    foreach ($paginatedTravels['elements'] as $travel) {
        $searchResults .= new TravelListItem($travel);
    }
    
    // Set search result travels
    $_page->replaceTag('SEARCH_RESULTS', $searchResults);

    // Set pagination indicator
    $_page->replaceTag('PAGE_SELECTOR', (new PageSelector($paginatedTravels)));
    // $_page .= "sei a pagina " . $paginatedTravels['currentPage'] . ' di ' . $paginatedTravels['totalPages'];

    $_page->replaceTag('FOOTER', (new Footer));

    echo $_page;