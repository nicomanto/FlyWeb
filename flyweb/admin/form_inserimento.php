<?php

    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();

    $page = new \html\template('board');

    $page->replaceTag('HEAD', (new \html\components\head));

    $breadcrumb=array(
        new model\BreadcrumbItem("/admin/index.php","Pannello di amministrazione"),
        new model\BreadcrumbItem("/admin/form_inserimento.php","Inserimento viaggio")
    );
    $page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("inserisci_viaggio")));

    $page->replaceTag('ADM-CONTENUTO', (new \html\components\FormViaggio));

    $page->replaceTag('ADM-FOOTER', (new \html\components\AdmFooter()));

    echo $page;