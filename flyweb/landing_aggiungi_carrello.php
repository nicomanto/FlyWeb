<?php

    use controllers\RouteController;
    use controllers\TravelController;
    use controllers\UserController;
    use html\components\BoxRelated;
    use html\components\BoxSuggerimenti;
    use html\components\Breadcrumb;
    use html\components\Footer;
    use html\components\Head;
    use html\components\Integrazione;
    use html\components\NoReviews;
    use html\components\PrincipalMenu;
    use html\components\TravelDetails;
    use html\components\TravelReviews;
    use html\components\ResponseMessage;
    use html\Template;
    use model\BreadcrumbItem;

    require_once('./autoload.php');

    RouteController::unprotectedRoute();

    // Load request's data
    extract($_POST, EXTR_SKIP);

    $travelController = new TravelController((int)$id_viaggio);
    $userController = new UserController();

    if (empty($userController->getID_Carrello())){
        $userController->newCart();
    }

    $id_carrello= $userController->getID_Carrello()['ID_Carrello'];
    $userController->addToCart($id_carrello, $id_viaggio);
  

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
        new BreadcrumbItem("./","Ricerca viaggio"),
        new BreadcrumbItem("./","Dettagli viaggio"),
        new BreadcrumbItem("#", "Viaggio nel carrello")
    );


    $_page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb))); 

    $_page->replaceTag('AGGIUNGI-CARRELLO', (new ResponseMessage("Hai inserito il viaggio nel carrello, continua a volare a fare in culo")));
    // Set footer
    $_page->replaceTag('FOOTER', (new Footer));

    echo $_page;

