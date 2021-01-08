<?php

use controllers\UserController;

require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    extract($_POST, EXTR_SKIP);

    $page = new \html\template('modifica_info_profilo');

    $page->replaceTag('HEAD', (new \html\components\head));
    // Set nav menu
    $page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    $breadcrumb=array(
        new model\BreadcrumbItem("/datipersonali.php","Profilo"),
        new model\BreadcrumbItem("/modifica_info_profilo.php","Modifica profilo"),
        new model\BreadcrumbItem("#","Conferma eliminazione")
    );

    $page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    $page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));

    $page->replaceTag('MODIFICA-INFO', "");
    $page->replaceTag('MODIFICA-PSW', "");
    $page->replaceTag('SUCCESSO-MODIFICA', "");

    $page->replaceTag('ELIMINAZIONE', (new \html\components\eliminazioneProfilo()));

    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;
