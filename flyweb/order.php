<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    extract($_GET, EXTR_SKIP);

    $orderController = new \controllers\OrderController((int)$id);

    $dettagli_ordine = $orderController->order;

    $viaggi = $orderController->getTravelByOrderList($id);
   

  
    $_page = new \html\template('order');

    $_page->replaceTag('HEAD', (new \html\components\head));

    $_page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    $breadcrumb=array(
        new model\BreadcrumbItem("/datipersonali.php","Profilo"),
        new model\BreadcrumbItem("/ordiniprofilo.php","Ordini effettuati"),
        new model\BreadcrumbItem("#", "Dettaglio ordine")
    );

    $_page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));


    $_page->replaceTag('ORDER_DETAILS', (new \html\components\orderDetails($dettagli_ordine,true)));



    foreach($viaggi as $li){
        $viaggio.= new \html\components\travelOrder($li);
    }

     $_page->replaceTag('CONTENUTO', $viaggio);

    $_page->replaceTag('FOOTER', (new \html\components\footer));

    echo $_page;