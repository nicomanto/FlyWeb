<?php
use model\BreadcrumbItem;

require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Load request's data
    extract($_GET, EXTR_SKIP);

    $userController=new \controllers\UserController();

    $items = $userController->getViaggiCarrello(); 

    $_page= new \html\template('riepilogo_ordine');

    $_page->replaceTag('HEAD', (new \html\components\head));

    $_page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
      new model\BreadcrumbItem("/carrello.php","Carrello"),
      new model\BreadcrumbItem("/metodopagamento.php","Metodo di pagamento"),
      new model\BreadcrumbItem("/landing_metodo_pagamento.php", "Inserisci dati di pagamento"),
      new model\BreadcrumbItem("/dati_fatturazione.php","Inserisci dati di fatturazione"),
      new model\BreadcrumbItem("#", "Riepilogo ordine")
    );

    $_page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    $_page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));

    
    $searchResults = '';
    foreach ($items as $li) {
        $searchResults .= new \html\components\travelOrder($li);
    }

    extract($_POST, EXTR_SKIP);

    $form1 = new \html\components\FormInserimentoDatiFatturazione();
    $fatturazione = $form1->estraiDatiFatturazione();

    $_page->replaceTag('DATI-INSERITI', (new \html\components\RiepilogoOrdine($fatturazione)));

    $_page->replaceTag('VIAGGI', $searchResults);

    $_page->replaceTag('TOTALE', (new \html\components\Totale($userController->getSubtotale())));

    $_page->replaceTag('FOOTER', (new \html\components\footer));

    echo $_page;