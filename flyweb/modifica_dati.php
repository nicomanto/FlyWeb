<?php

use controllers\UserController;

require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    extract($_POST, EXTR_SKIP);
    $admController = new \controllers\AdmController();
    $userController= new \controllers\UserController();
    
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

    $page = new \html\template('modifica_info_profilo');

    $page->replaceTag('HEAD', (new \html\components\head));
    // Set nav menu
    $page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    $breadcrumb=array(
        new model\BreadcrumbItem("/datipersonali.php","Profilo"),
        new model\BreadcrumbItem("/modifica_info_profilo.php","Modifica profilo"),
        new model\BreadcrumbItem("#","Riscontro modifica")
    );

    $page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    $page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));

    $page->replaceTag('SUCCESSO-MODIFICA', (new \html\components\SuccessoModifica));

    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;
