<?php

use model\Paginator;

require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Load request's data
    extract($_GET, EXTR_SKIP);
    $admController = new \controllers\AdmController();
    $userController= new \controllers\UserController();

    // Set pagination to page 1 if not specified differently
    $page = isset($page) ? $page : 1;

    
    $ordini = $userController->getOrderList();

    $paginatedOrders = Paginator::paginate($ordini, $page);

    $_page= new \html\template('profilo');

    $_page->replaceTag('HEAD', (new \html\components\head));

    $_page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    $_page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));

    $searchResults = '';
    foreach ($paginatedOrders['elements'] as $ordine) {
        $searchResults .= new \html\components\orderListItem($ordine);
    }

    if (empty($searchResults)) {
        $_page->replaceTag('ORDINI-PROFILO', ("Non hai ancora effettuato nessun ordine!"));
    }

    //dovrei fare un componente apposito per segnalare mancanza di ordini?

    else {
        $_page->replaceTag('ORDINI-PROFILO', $searchResults);
    }

    $_page->replaceTag('PAGE_SELECTOR', (new \html\components\pageSelector($paginatedOrders)));

    $_page->replaceTag('FOOTER', (new \html\components\footer));

    echo $_page;