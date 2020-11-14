<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $travelController = new \controllers\TravelController(12);

    // Loading signup template
    $page = (new html\components\TravelReviews($travelController->getTravelReviewsList()));

    echo $page;
