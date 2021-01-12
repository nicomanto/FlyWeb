<?php

    use controllers\RouteController;
    use controllers\TravelController;
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
    use html\Template;
    use model\BreadcrumbItem;

    require_once('./autoload.php');

    RouteController::unprotectedRoute();

    // Load request's data
    extract($_GET, EXTR_SKIP);

    if (empty($id)) {
        header('location:./search.php');
        exit();
    }

    $travelController = new TravelController((int)$id);

    // Loading travel detail template
    $_page = new Template('travel');

    // Replace values in template
    $_page->replaceValue('TRAVEL_NAME', $travelController->travel->titolo);

    // Set page head
    $_page->replaceTag('HEAD', (new Head));

    // Set nav menu
    $_page->replaceTag('NAV-MENU', (new PrincipalMenu));

    // Set breadcrumb
    // Da vedere come fare serach.php perchè reindirizza a index.php perchè mancano gli elementi per la get
    $breadcrumb=array(
        new BreadcrumbItem("./index.php","Home","en"),
        new BreadcrumbItem("javascript:history.back()","Ricerca viaggio"),
        new BreadcrumbItem("#","Dettagli viaggio")
    );


    $_page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    // Set travel details
    $_page->replaceTag('TRAVEL_DETAILS', (new TravelDetails($travelController->travel)));

    // Set travel configurator
    $_page->replaceTag('INTEGRATION_CONFIGURATOR', (new Integrazione((int)$id)));


    if($travelController->haveRelatedTravel()){
        $_page->replaceTag('RELATED_TRAVELS', (new BoxRelated($travelController->getIdTag(),(int)$id)));
    }
    else{
        $_page->replaceTag('RELATED_TRAVELS', (new BoxSuggerimenti));
    }

    // Set travel reviews
    if($travelController->haveReviews() && $travelController->haveModReview()){
        $_page->replaceTag('TRAVEL_REVIEWS', (new TravelReviews($travelController)));
    }
    else{
        $_page->replaceTag('TRAVEL_REVIEWS', (new NoReviews()));
    }

    // Set footer
    $_page->replaceTag('FOOTER', (new Footer));

    echo $_page;

