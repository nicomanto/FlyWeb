<?php

    use controllers\RouteController;
    use controllers\UserController;
    use html\components\Breadcrumb;
    use html\components\Footer;
    use html\components\FormInserimentoDatiFatturazione;
    use html\components\Head;
    use html\components\PrincipalMenu;
    use html\components\ProfiloMenu;
    use html\Template;
    use model\BreadcrumbItem;

    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');
    RouteController::loggedRoute();

    // Load request's data
    extract($_GET, EXTR_SKIP);

    $userController=new UserController();

    $items = $userController->getViaggiCarrello();

    $_page= new Template('riepilogo');

    $_page->replaceTag('HEAD', (new Head));

    $_page->replaceTag('NAV-MENU', (new PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new BreadcrumbItem("/carrello.php","Carrello"),
        new BreadcrumbItem("#","Riepilogo Ordine")
    );

    $_page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    $_page->replaceTag('PROFILOMENU', (new ProfiloMenu));

    
    // $searchResults = '';
    // foreach ($items as $li) {
    //     $searchResults .= new TravelOrder($li);
    // }

    // $_page->replaceTag('VIAGGI-DA-ACQUISTARE', $searchResults);

    $_page->replaceTag('INSERIMENTO-DATI', (new FormInserimentoDatiFatturazione()));    

    //$_page->replaceTag('SUB-TOTALE', (new \html\components\subtotale) );
  //  $_page->replaceTag('SUB-TOTALE',new \html\components\subtotale($userController->getSubtotale()));

    $_page->replaceTag('FOOTER', (new Footer));

    echo $_page;