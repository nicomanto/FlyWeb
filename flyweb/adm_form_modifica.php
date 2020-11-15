<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $page = new \html\template('board');

    echo $page;

    // Set page head
    //$page->replaceTag('HEAD', (new \html\components\head));

    // Set nav menu
    //$page->replaceTag('ADM-NAV-MENU', (new \html\components\NavMenu));

    
    $page->replaceTag('ADM-FORM-INSERIMENTO-VIAGGIO', (new \html\components\FormViaggio()));
    $page->replaceTag('ADM-SUCCESSO', " ");


    echo $page;