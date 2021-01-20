<?php

    use controllers\RouteController;
    use controllers\UserController;
    use html\components\Breadcrumb;
    use html\components\Footer;
    use html\components\Head;
    use html\components\PrincipalMenu;
    use html\components\ProfiloMenu;
    use html\components\SuccessoModifica;
    use html\Template;
    use model\BreadcrumbItem;

    require_once('./autoload.php');

    RouteController::loggedRoute();

    extract($_POST, EXTR_SKIP);
    $userController= new UserController();

    if ($username){
        $userController->user->username = $username;
    }
    
    if ($email) {
        $userController->user->email = $email;
    }

    if ($nome) {
        $userController->user->nome = $nome;
    }

    if ($cognome) {
        $userController->user->cognome = $cognome;
    }

    if ($data_nascita) {
        $userController->user->data_nascita = $data_nascita;
    }


    $userController->aggiornaUtente();

    $page = new Template('modifica_info_profilo');

    $page->replaceTag('HEAD', (new Head));
    // Set nav menu
    $page->replaceTag('NAV-MENU', (new PrincipalMenu));

    $breadcrumb=array(
        new BreadcrumbItem("./datipersonali.php","Profilo"),
        new BreadcrumbItem("./modifica_info_profilo.php","Modifica profilo"),
        new BreadcrumbItem("#","Riscontro modifica")
    );

    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    $page->replaceTag('PROFILOMENU', (new ProfiloMenu));

    $page->replaceTag('SUCCESSO-MODIFICA', (new SuccessoModifica));

    $page->replaceTag('ELIMINAZIONE', '');

    $page->replaceTag('MODIFICA-PSW', '');

    $page->replaceTag('MODIFICA-INFO', '');

    $page->replaceTag('FOOTER', (new Footer));

    echo $page;
