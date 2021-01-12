<?php

    use controllers\RouteController;
    use controllers\UserController;
    use html\components\Breadcrumb;
    use html\components\Footer;
    use html\components\Head;
    use html\components\MetodoPagamento;
    use html\components\PrincipalMenu;
    use html\components\ProfiloMenu;
    use html\Template;
    use model\BreadcrumbItem;

    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');
    RouteController::loggedRoute();

    // Load request's data
    extract($_GET, EXTR_SKIP);

    $userController=new UserController();

   // $items = $userController->getViaggiCarrello();

    $_page= new Template('procedura_acquisto');

    $_page->replaceTag('HEAD', (new Head));

    $_page->replaceTag('NAV-MENU', (new PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new BreadcrumbItem("./carrello.php","Carrello"),
        new BreadcrumbItem("#","Metodo di pagamento")
    );

    $_page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    $_page->replaceTag('PROFILOMENU', (new ProfiloMenu));

    

    $_page->replaceTag('VIAGGI-DA-ACQUISTARE', '');

    $_page->replaceTag('INSERIMENTO-DATI', '');

    $_page->replaceTag('INSERIMENTO-METODO-PAGAMENTO', (new MetodoPagamento()));

    $_page->replaceTag('TOTALE', '');

    $_page->replaceTag('FOOTER', (new Footer));

    echo $_page;