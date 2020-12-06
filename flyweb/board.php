<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // This route can be accessed only by admins
    (new \controllers\RouteController)->protectRoute();


    $page = new \html\template('board');


    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard));

    $page->replaceTag('ADM-CONTENUTO', '');

    $page->replaceTag('ADM-LIST','');

    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;