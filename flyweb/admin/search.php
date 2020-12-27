<?php
    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();


    $page = new \html\template('board');

    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));

    // Set nav menu
    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard));

    $page->replaceValue('TITOLO', "MODIFICA O ELIMINA UN VIAGGIO");

    // Set search box form
    $page->replaceTag('ADM-CONTENUTO', (new \html\components\searchBox("adm-searchbox")));

    echo $page;