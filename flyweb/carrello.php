<?php

    use controllers\RouteController;
    use controllers\UserController;
    use html\components\Breadcrumb;
    use html\components\CarrelloElementi;
    use html\components\Footer;
    use html\components\Head;
    use html\components\PageSelector;
    use html\components\PrincipalMenu;
    use html\components\ProfiloMenu;
    use html\components\ResponseMessage;
    use html\components\Subtotale;
    use html\Template;
    use model\BreadcrumbItem;
    use model\Paginator;

    require_once('./autoload.php');
    RouteController::loggedRoute();


    // Load request's data
    extract($_GET, EXTR_SKIP);

    $userController=new UserController();
    
    extract($_POST, EXTR_SKIP);

    if(!empty($_POST)){
        if($_POST['btn_elimina']){
            $userController->deleteViaggioCarrello($id_elemento_carrello);
        }
    }

    $page = isset($page) ? $page : 1;

    $items = $userController->getViaggiCarrello();

    $paginatedViaggiCarrello = Paginator::paginate($items, $page);

    $_page= new Template('carrello');

    $_page->replaceTag('HEAD', (new Head));

    $_page->replaceTag('NAV-MENU', (new PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new BreadcrumbItem("#","Carrello")
    );

    $_page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    $_page->replaceTag('PROFILOMENU', (new ProfiloMenu));


    $results = '';
    
    foreach ($paginatedViaggiCarrello['elements'] as $elementoCarrello) {
        $id_elemento_carrello = $elementoCarrello['ID_Carrello'];
        unset($elementoCarrello['ID_Carrello']);
        $results .= new CarrelloElementi($elementoCarrello, $id_elemento_carrello);
    }

    if (empty($results)) {
        $_page->replaceTag('RISPOSTA', (new ResponseMessage("Il tuo carrello è vuoto")));
        $_page->replaceTag('PAGE_SELECTOR', '');
        $_page->replaceTag('SUB-TOTALE', '');
        $_page->replaceTag('ORDER_DETAILS', '');
        $_page->replaceTag('CONTENUTO-CARRELLO', '');
    }

    else {
        $_page->replaceTag('CONTENUTO-CARRELLO', $results);
        $_page->replaceTag('PAGE_SELECTOR', (new PageSelector($paginatedViaggiCarrello)));
        $_page->replaceTag('SUB-TOTALE',new Subtotale($userController->getSubtotale()));
        $_page->replaceTag('RISPOSTA', '');
    }

    $_page->replaceTag('FOOTER', (new Footer));

    echo $_page;