<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Load request's data
    extract($_GET, EXTR_SKIP);
    $userController = new \controllers\UserController();
    $vecchia_password = $userController->getPassword();
    

    extract($_POST, EXTR_SKIP);

    $password_corrente = md5($password_corrente);
    $nuova_password = md5($nuova_password);
    $password_ripetuta = md5($password_ripetuta);
 
   
    if ($password_corrente != $vecchia_password['Password']){
        echo 'La password corrente non è esatta';
        exit();
    };
 
 
    if ($nuova_password != $password_ripetuta) {
        echo 'Le password inserite non corrispondono, riprova.';
        exit();
    };

    if ($nuova_password) {
        $userController->user->password = $nuova_password;
    };

    $userController->aggiornaPsw();

    $page = new \html\template('modifica_info_profilo');

    $page->replaceTag('HEAD', (new \html\components\head));
    // Set nav menu
    $page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    $breadcrumb=array(
        new model\BreadcrumbItem("/datipersonali.php","Profilo"),
        new model\BreadcrumbItem("/modifica_info_psw.php","Modifica password"),
        new model\BreadcrumbItem("#","Riscontro modifica")
    );

    $page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));
    
    $page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));

    $page->replaceTag('SUCCESSO-MODIFICA', (new \html\components\SuccessoModifica));

    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;
 