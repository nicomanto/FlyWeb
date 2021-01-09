<?php

    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();

    $page = new Template('board');

    $page->replaceTag('HEAD', (new Head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("inserisci_integrazione")));

    $page->replaceTag('ADM-CONTENUTO', (new \html\components\AdmFormIntegrazione()));

    echo $page;