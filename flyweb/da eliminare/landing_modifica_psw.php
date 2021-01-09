<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Load request's data
    extract($_GET, EXTR_SKIP);
    $userController = new UserController();
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

    $page = new Template('modifica_info_profilo');

    $page->replaceTag('HEAD', (new Head));
    // Set nav menu
    $page->replaceTag('NAV-MENU', (new PrincipalMenu));

    $breadcrumb=array(
        new BreadcrumbItem("/datipersonali.php","Profilo"),
        new BreadcrumbItem("/modifica_info_psw.php","Modifica password"),
        new BreadcrumbItem("#","Riscontro modifica")
    );

    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));
    
    $page->replaceTag('PROFILOMENU', (new ProfiloMenu));

    if($check1 && $check2){
        $page->replaceTag('SUCCESSO-MODIFICA', (new SuccessoModifica));
    }else{
        if(!$check1 && !$check2){
            $page->replaceTag('SUCCESSO-MODIFICA', (new ResponseMessage("La password corrente non è esatta e le password nuove non combaciano")));

        }else if(!$check1){
            $page->replaceTag('SUCCESSO-MODIFICA', (new ResponseMessage("La password corrente non è esatta")));
        }else if(!$check3){
            $page->replaceTag('SUCCESSO-MODIFICA', (new ResponseMessage("La password nuova è uguale alla vecchia")));
        }else {
            $page->replaceTag('SUCCESSO-MODIFICA', (new ResponseMessage("Password nuove non combaciano")));
        }
    }

    $page->replaceTag('FOOTER', (new Footer));

    echo $page;
 