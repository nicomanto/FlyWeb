<?php

    use controllers\OrderController;
    use controllers\RouteController;
    use html\components\Breadcrumb;
    use html\components\Footer;
    use html\components\Head;
    use html\components\OrderDetails;
    use html\components\PrincipalMenu;
    use html\components\TravelOrder;
    use html\Template;
    use model\BreadcrumbItem;

    require_once('./autoload.php');
    RouteController::loggedRoute();

    extract($_GET, EXTR_SKIP);

    $orderController = new OrderController((int)$id);
    $dettagli_ordine = $orderController->order;

    $viaggi = $orderController->getTravelByOrderList($id);
   

  
    $_page = new Template('order');

    $_page->replaceTag('HEAD', (new Head));

    $_page->replaceTag('NAV-MENU', (new PrincipalMenu));

    $breadcrumb=array(
        new BreadcrumbItem("./datiPersonali.php","Profilo"),
        new BreadcrumbItem("./ordiniProfilo.php","Ordini effettuati"),
        new BreadcrumbItem("#", "Dettaglio ordine")
    );

    $_page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));


    $_page->replaceTag('ORDER_DETAILS', (new OrderDetails($dettagli_ordine,true)));
    $_page->replaceTag('ORDINI-PROFILO', '');


    foreach($viaggi as $li){
        $viaggio.= new TravelOrder($li);
    }

    $_page->replaceTag('CONTENUTO', "<ul>".$viaggio."</ul>");

    $_page->replaceTag('PAGE_SELECTOR', '');

    $_page->replaceTag('FOOTER', (new Footer));

    echo $_page;