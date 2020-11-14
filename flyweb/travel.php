<?php

    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Load request's data
    extract($_GET, EXTR_SKIP);

    if (empty($id)) {
        header('location:/search.php');
        exit();
    }

    $travelController = new \controllers\TravelController((int)$id);

    // Loading travel detail template
    $_page = new \html\template('travel');

    // Replace values in template
    $_page->replaceValue('TRAVEL_NAME', $travelController->travel->nome);

    // Set page head
    $_page->replaceTag('HEAD', (new \html\components\head));

    // Set nav menu
    $_page->replaceTag('NAV-MENU', (new \html\components\NavMenu));

    // Set travel details
    $_page->replaceTag('TRAVEL_DETAILS', (new \html\components\travelDetails($travelController->travel)));

    // Set travel reviews
    if($travelController->haveReviews()){
        $_page->replaceTag('TRAVEL_REVIEWS', (new \html\components\travelReviews($travelController->getTravelReviewsList())));
    }
    else{
        $_page->replaceTag('TRAVEL_REVIEWS', '');
    }
    

    // Set footer
    $_page->replaceTag('FOOTER', (new \html\components\footer));

    echo $_page;


