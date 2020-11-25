<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $page = new \html\template('board');
    $admController = new \controllers\AdmController;


    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard));

    if($admController->haveUnapprovedReviews()){
        //print_r($admController->getUnapprovedReviewsList());
        $page->replaceTag('ADM-CONTENUTO', (new \html\components\travelReviews($admController->getUnapprovedReviewsList())));
    }else{
        $page->replaceTag('ADM-CONTENUTO', '<h2>Non ci sono recensioni da moderare...per ora</h2>');
    }

    $page->replaceTag('ADM-LIST','');

    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;