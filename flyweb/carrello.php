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

    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');
    RouteController::loggedRoute();


    // Load request's data
    extract($_GET, EXTR_SKIP);

    $userController=new UserController();
    
    extract($_POST, EXTR_SKIP);

    if(!empty($_POST)){
        if($_POST['btn_elimina']){
            $userController->deleteViaggioCarrello($id_viaggio);
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
    
    foreach ($paginatedViaggiCarrello['elements'] as $viaggio) {
        $results .= new CarrelloElementi($viaggio);
    }

    if (empty($results)) {
        $_page->replaceTag('CONTENUTO-CARRELLO', (new ResponseMessage("Il tuo carrello è vuoto")));
        $_page->replaceTag('PAGE_SELECTOR', ' ');

    }

    else {
        $_page->replaceTag('CONTENUTO-CARRELLO', $results);
        $_page->replaceTag('PAGE_SELECTOR', (new PageSelector($paginatedViaggiCarrello)));
        $_page->replaceTag('SUB-TOTALE',new Subtotale($userController->getSubtotale()));

    }

    $_page->replaceTag('FOOTER', (new Footer));

    echo $_page;