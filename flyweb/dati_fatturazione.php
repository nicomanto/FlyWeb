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
        new model\BreadcrumbItem("/metodopagamento.php","Metodo di pagamento"),
        new model\BreadcrumbItem("/landing_metodo_pagamento.php", "Inserisci dati di pagamento"),
        new model\BreadcrumbItem("#","Inserisci dati di fatturazione")
    );

    $_page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    $_page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));

    
//    $searchResults = '';
//    foreach ($items as $li) {
//        $searchResults .= new \html\components\travelOrder($li);
//    }

//    $_page->replaceTag('VIAGGI-DA-ACQUISTARE', $searchResults);

    $_page->replaceTag('INSERIMENTO-DATI', (new \html\components\FormInserimentoDatiFatturazione()));

  //  $_page->replaceTag('INSERIMENTO-METODO-PAGAMENTO', (new \html\components\metodoPagamento()));
    

    //$_page->replaceTag('SUB-TOTALE', (new \html\components\subtotale) );
  //  $_page->replaceTag('SUB-TOTALE',new \html\components\subtotale($userController->getSubtotale()));

    $_page->replaceTag('FOOTER', (new \html\components\footer));

    echo $_page;