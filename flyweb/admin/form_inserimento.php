<?php

    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();

    $page = new \html\template('board');

    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("inserisci_viaggio")));

    $page->replaceTag('ADM-CONTENUTO', (new \html\components\FormViaggio));

    echo $page;