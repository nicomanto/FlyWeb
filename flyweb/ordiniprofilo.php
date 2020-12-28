<?php
use model\BreadcrumbItem;
use model\Paginator;

require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Load request's data
    extract($_GET, EXTR_SKIP);
    $userController= new \controllers\UserController();

    // Set pagination to page 1 if not specified differently
    $page = isset($page) ? $page : 1;

    $ordini = $userController->getOrderList();

    $paginatedOrders = Paginator::paginate($ordini, $page);

    $_page= new \html\template('order');

    $_page->replaceTag('HEAD', (new \html\components\head));

    $_page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new model\BreadcrumbItem("/datipersonali.php","Profilo"),
        new model\BreadcrumbItem("#","Ordini effettuati")
    );

    $_page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    $_page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));

    $searchResults = '';
    
    foreach ($paginatedOrders['elements'] as $ordine) {
        $searchResults .= new \html\components\orderListItem($ordine);
    }

    if (empty($searchResults)) {
        $_page->replaceTag('ORDINI-PROFILO', (new \html\components\responseMessage("Non hai nessun ordine per ora...")));
        $_page->replaceTag('PAGE_SELECTOR', ' ');

    }

    //dovrei fare un componente apposito per segnalare mancanza di ordini?

    else {
        $_page->replaceTag('ORDINI-PROFILO', $searchResults);
        $_page->replaceTag('PAGE_SELECTOR', (new \html\components\pageSelector($paginatedOrders)));

    }


    $_page->replaceTag('FOOTER', (new \html\components\footer));

    echo $_page;