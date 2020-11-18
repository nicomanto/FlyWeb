<?php

    //pagina che uso per test php, andrà rimossa
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $page = new \html\template('board');


    $page->replaceTag('HEAD', new \html\components\Head);

    $page->replaceTag('ADM-DASHBOARD', (new \html\components\Integrazione("133")));

    $page->replaceTag('ADM-SUCCESSO', '');

    echo $page;