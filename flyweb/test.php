<?php

    //pagina che uso per test php, andrà rimossa
    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    // Load request's data
    extract($_GET, EXTR_SKIP);

    $travelController = new \controllers\TravelController((int)49);

    // Loading travel detail template
    $_page = new \html\template('travel');

    // Replace values in template
    $_page->replaceValue('TRAVEL_NAME', $travelController->travel->titolo);

    // Set page head
    $_page->replaceTag('HEAD', (new \html\components\head));

    // Set nav menu
    $_page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    // Set travel details
    $_page->replaceTag('TRAVEL_DETAILS', (new \html\components\travelDetails($travelController->travel)));

    // Set travel configurator
    $_page->replaceTag('INTEGRATION_CONFIGURATOR', (new \html\components\integrazione((int)49)));

    $_page->replaceTag('RELATED_TRAVELS', (new \html\components\boxSuggerimenti));

    // Set travel reviews
    if($travelController->haveReviews() && $travelController->haveModReview()){
        $_page->replaceTag('TRAVEL_REVIEWS', (new \html\components\travelReviews($travelController)));
    }
    else{
        $_page->replaceTag('TRAVEL_REVIEWS', (new \html\components\noReviews()));
    }
    

    // Set footer
    $_page->replaceTag('FOOTER', (new \html\components\footer));

    echo $_page;