<?php

    use controllers\RouteController;
    use controllers\UserController;
    use html\components\Breadcrumb;
    use html\components\Footer;
    use html\components\Head;
    use html\components\OrderListItem;
    use html\components\PageSelector;
    use html\components\PrincipalMenu;
    use html\components\ProfiloMenu;
    use html\components\ResponseMessage;
    use html\Template;
    use model\BreadcrumbItem;
    use model\Paginator;

    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');
    RouteController::loggedRoute();

    // Load request's data
    extract($_GET, EXTR_SKIP);
    $userController= new UserController();

    // Set pagination to page 1 if not specified differently
    $page = isset($page) ? $page : 1;

    $ordini = $userController->getOrderList();

    $paginatedOrders = Paginator::paginate($ordini, $page);

    $_page= new Template('order');

    $_page->replaceTag('HEAD', (new Head));

    $_page->replaceTag('NAV-MENU', (new PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new BreadcrumbItem("./datipersonali.php","Profilo"),
        new BreadcrumbItem("#","Ordini effettuati")
    );

    $_page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    $_page->replaceTag('PROFILOMENU', (new ProfiloMenu));

    $searchResults = '';
    
    foreach ($paginatedOrders['elements'] as $ordine) {
        $searchResults .= new OrderListItem($ordine);
    }

    if (empty($searchResults)) {
        $_page->replaceTag('ORDINI-PROFILO', (new ResponseMessage("Non hai nessun ordine per ora...")));
        $_page->replaceTag('PAGE_SELECTOR', ' ');

    }


    else {
        $_page->replaceTag('ORDINI-PROFILO', $searchResults);
        $_page->replaceTag('PAGE_SELECTOR', (new PageSelector($paginatedOrders)));

    }

    $_page->replaceTag('ORDER_DETAILS', "");
    $_page->replaceTag('CONTENUTO', "");

    $_page->replaceTag('FOOTER', (new Footer));

    echo $_page;