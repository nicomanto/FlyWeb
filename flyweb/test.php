<?php

    //pagina che uso per test php, andrà rimossa
    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    $page = new \html\template('board');


    $page->replaceTag('HEAD', new \html\components\head);

    $page->replaceTag('ADM-DASHBOARD', (new \html\components\integrazione("133")));

    $page->replaceTag('ADM-SUCCESSO', '');

    echo $page;