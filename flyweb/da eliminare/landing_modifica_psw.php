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
 
   $check1=true;
   $check2=true;
   $check3=true;

    if ($password_corrente != $vecchia_password['Password']){
        $check1=false;
    };
    if ($nuova_password != $password_ripetuta || !$nuova_password) {
        $check2=false;
    };
    if ($nuova_password == $vecchia_password['Password']){
        $check3=false;
    }

    if ($check1 && $check2 && $check3 && $nuova_password) {
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

    if($check1 && $check2){
        $page->replaceTag('SUCCESSO-MODIFICA', (new \html\components\SuccessoModifica));
    }else{
        if(!$check1 && !$check2){
            $page->replaceTag('SUCCESSO-MODIFICA', (new \html\components\responseMessage("La password corrente non è esatta e le password nuove non combaciano")));

        }else if(!$check1){
            $page->replaceTag('SUCCESSO-MODIFICA', (new \html\components\responseMessage("La password corrente non è esatta")));
        }else if(!$check3){
            $page->replaceTag('SUCCESSO-MODIFICA', (new \html\components\responseMessage("La password nuova è uguale alla vecchia")));
        }else {
            $page->replaceTag('SUCCESSO-MODIFICA', (new \html\components\responseMessage("Password nuove non combaciano")));
        }
    }

    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;
 