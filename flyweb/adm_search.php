<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');


    $page = new \html\template('board');

    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));

    // Set nav menu
    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("gestisci_viaggi")));

    // Set search box form
    $page->replaceTag('ADM-CONTENUTO', (new \html\components\SearchBox("adm-searchbox")));

    $page->replaceTag('ADM-LIST','');

    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;