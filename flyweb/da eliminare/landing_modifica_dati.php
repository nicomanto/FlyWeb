<?php

use controllers\UserController;

require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

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
        new BreadcrumbItem("/datipersonali.php","Profilo"),
        new BreadcrumbItem("/modifica_info_profilo.php","Modifica profilo"),
        new BreadcrumbItem("#","Riscontro modifica")
    );

    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    $page->replaceTag('PROFILOMENU', (new ProfiloMenu));

    $page->replaceTag('SUCCESSO-MODIFICA', (new SuccessoModifica));

    $page->replaceTag('FOOTER', (new Footer));

    echo $page;
