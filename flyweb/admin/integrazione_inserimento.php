<?php

    use controllers\RouteController;
    use html\components\AdmDashBoard;
    use html\components\AdmFormIntegrazione;
    use html\components\Head;
    use html\Template;

    require_once('../autoload.php');

    RouteController::protectedRoute();

    $page = new Template('board');

    $page->replaceTag('HEAD', (new Head));

    $page->replaceTag('ADM-MENU', (new AdmDashboard("inserisci_integrazione")));

    $page->replaceTag('ADM-CONTENUTO', (new AdmFormIntegrazione()));

    echo $page;