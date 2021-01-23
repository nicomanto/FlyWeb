<?php

    use controllers\RouteController;
    use controllers\TravelController;
    use controllers\UserController;
    use html\components\Breadcrumb;
    use html\components\Footer;
    use html\components\Head;
    use html\components\PrincipalMenu;
    use html\components\ResponseMessage;
    use html\Template;
    use model\BreadcrumbItem;

    require_once('./autoload.php');

    RouteController::loggedRoute();

    // Load request's data
    extract($_POST, EXTR_SKIP);


    // If id_viaggio was not provided in $_POST try getting it from $_SESSION
    if (!((int)$id_viaggio)) {
        if($_SESSION['redirect_body']['id_viaggio']) {
            $id_viaggio = $_SESSION['redirect_body']['id_viaggio'];
            unset($_SESSION['redirect_body']);
        } else {
            header('Location: ./index.html');
        }
    }

    $travelController = new TravelController((int)$id_viaggio);
    $userController = new UserController();

    if (empty($userController->getID_Carrello())){
        $userController->newCart();
    }

    $id_carrello= $userController->getID_Carrello()['ID_Carrello'];
    $userController->addToCart($id_viaggio);
  

    // Loading travel detail template
    $_page = new Template('travel');


    // Set page head
    $_page->replaceTag('HEAD', (new Head));

    // Set nav menu
    $_page->replaceTag('NAV-MENU', (new PrincipalMenu));

    // Set breadcrumb
    // Da vedere come fare serach.php perchè reindirizza a index.php perchè mancano gli elementi per la get
    $breadcrumb=array(
        new BreadcrumbItem("./index.php","Home","en"),
        new BreadcrumbItem("./search.php?search_key=&search_button=CERCA&search_start_date=&search_end_date=&search_end_price=&search_start_price=&search_by_option=Citta&search_order_by=Prezzo&search_order_by_mode=Ascendente","Ricerca viaggio","Ricerca viaggio"),
        new BreadcrumbItem("./travel.php?id=".$id_viaggio,"Dettagli viaggio"),
        new BreadcrumbItem("#", "Viaggio nel carrello")
    );


    $_page->replaceValue('TRAVEL_NAME', $travelController->travel->titolo);
    $_page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb))); 

    $_page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb))); 

    $_page->replaceTag('AGGIUNGI-CARRELLO', (new ResponseMessage("Hai inserito il viaggio nel carrello, prosegui al <a class=\"upper_link\" lang=\"en\" href=\"./carrello.php\">carrello</a> o continua la <a class=\"upper_link\" href=\"./search.php?search_key=&search_button=CERCA&search_start_date=&search_end_date=&search_end_price=&search_start_price=&search_by_option=Citta&search_order_by=Prezzo&search_order_by_mode=Ascendente\">ricerca</a>")));
    // Set footer
    $_page->replaceTag('FOOTER', (new Footer));

    echo $_page;

