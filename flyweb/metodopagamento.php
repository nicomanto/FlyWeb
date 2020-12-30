<?php
use model\BreadcrumbItem;

require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Load request's data
    extract($_GET, EXTR_SKIP);

    $userController=new \controllers\UserController();

   // $items = $userController->getViaggiCarrello();

    $_page= new \html\template('riepilogo');

    $_page->replaceTag('HEAD', (new \html\components\head));

    $_page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new model\BreadcrumbItem("/carrello.php","Carrello"),
        new model\BreadcrumbItem("#","Metodo di pagamento")
    );

    $_page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    $_page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));

    

    $_page->replaceTag('VIAGGI-DA-ACQUISTARE', '');

    $_page->replaceTag('INSERIMENTO-DATI', '');

    $_page->replaceTag('INSERIMENTO-METODO-PAGAMENTO', (new \html\components\metodoPagamento()));
    

    $_page->replaceTag('TOTALE', '');

    $_page->replaceTag('FOOTER', (new \html\components\footer));

    echo $_page;