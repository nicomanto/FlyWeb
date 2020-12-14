<?php

    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');


    extract($_GET, EXTR_SKIP);

    $orderController = new \controllers\OrderController((int)3);
 
    $travelController = new \controllers\TravelController((int)2);

    $_page = new \html\template('order');


    $_page->replaceTag('HEAD', (new \html\components\head));

    $_page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    $_page->replaceTag('ORDER_DETAILS', (new \html\components\orderDetails($orderController->order)));

    $_page->replaceTag('CONTENUTO', (new \html\components\travelOrder($travelController->travel)));

    //ho messo solo un viaggio -> più viaggi in un ordine? + Integrazioni 
    
    $_page->replaceTag('FOOTER', (new \html\components\footer));

    echo $_page;
