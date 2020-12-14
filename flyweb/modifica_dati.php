<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    extract($_POST, EXTR_SKIP);
    $admController = new \controllers\AdmController();
    $nome = $_COOKIE['flw_user'];
    $id=$admController->getIDFromUsername($nome);
    $userController= new \controllers\UserController($id['ID_Utente']);

    $form = new \html\components\modificainfoprofilo($id['ID_Utente']);
    $user = $form->estraiDatiUtente($id['ID_Utente']);

    $user['id_utente'] = $id['ID_Utente'];

    $userController->aggiornaUtente($user);

    $page = new \html\template('modifica_info_profilo');

    $page->replaceTag('HEAD', (new \html\components\head));
    // Set nav menu
    $page->replaceTag('NAV-MENU', (new \html\components\NavMenu));

    $page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));

    $page->replaceTag('SUCCESSO-MODIFICA', (new \html\components\SuccessoModifica));

    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;
