<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $page = new \html\template('board');

    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-FORM-INSERIMENTO-VIAGGIO', (new \html\components\FormViaggio));

    $page->replaceTag('ADM-SUCCESSO', '');
    $page->replaceTag('ADM-DASHBOARD', '');
    $page->replaceTag('ADM-REVIEWS', '');



    echo $page;