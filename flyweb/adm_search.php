<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');


    $page = new \html\template('index');

    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));

    // Set nav menu
    $page->replaceTag('NAV-MENU', ' ');

    // Set search box form
    $page->replaceTag('SEARCH_BOX', (new \html\components\searchBox));

    echo $page;