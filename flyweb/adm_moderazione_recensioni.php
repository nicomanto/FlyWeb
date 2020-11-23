<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $page = new \html\template('board');
    $admController = new \controllers\AdmController;


    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-FORM-INSERIMENTO-VIAGGIO', '');
    $page->replaceTag('ADM-SUCCESSO', '');
    $page->replaceTag('ADM-DASHBOARD', '');
    $page->replaceTag('ADM-FORM-INSERIMENTO-INTEGRAZIONE', '');

    if($admController->haveUnapprovedReviews()){
        //print_r($admController->getUnapprovedReviewsList());
        $page->replaceTag('ADM-REVIEWS', (new \html\components\travelReviews($admController->getUnapprovedReviewsList())));
    }else{
        $page->replaceTag('ADM-REVIEWS', '<h2>Non ci sono recensioni da moderare...per ora</h2>');
    }


    echo $page;