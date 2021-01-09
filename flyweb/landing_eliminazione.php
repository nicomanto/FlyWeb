<?php

    use controllers\RouteController;
    use html\components\Breadcrumb;
    use html\components\EliminazioneProfilo;
    use html\components\Footer;
    use html\components\Head;
    use html\components\PrincipalMenu;
    use html\components\ProfiloMenu;
    use html\Template;
    use model\BreadcrumbItem;

    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');
    RouteController::loggedRoute();

    extract($_POST, EXTR_SKIP);

    $page = new Template('modifica_info_profilo');

    $page->replaceTag('HEAD', (new Head));
    // Set nav menu
    $page->replaceTag('NAV-MENU', (new PrincipalMenu));

    $breadcrumb=array(
        new BreadcrumbItem("/datipersonali.php","Profilo"),
        new BreadcrumbItem("/modifica_info_profilo.php","Modifica profilo"),
        new BreadcrumbItem("#","Conferma eliminazione")
    );

    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    $page->replaceTag('PROFILOMENU', (new ProfiloMenu));

    $page->replaceTag('MODIFICA-INFO', "");
    $page->replaceTag('MODIFICA-PSW', "");
    $page->replaceTag('SUCCESSO-MODIFICA', "");

    $page->replaceTag('ELIMINAZIONE', (new EliminazioneProfilo()));

    $page->replaceTag('FOOTER', (new Footer));

    echo $page;
