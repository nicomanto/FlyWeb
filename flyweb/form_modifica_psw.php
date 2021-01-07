<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $error=array();
 
    $page = new \html\template('modifica_info_profilo');

    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    $breadcrumb=array(
        new model\BreadcrumbItem("/datipersonali.php","Profilo"),
        new model\BreadcrumbItem("#","Modifica Password")
    );

    $page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    if(isset($_POST['submit'])) {

        $userController= new \controllers\UserController();
        $vecchia_password = $userController->getPassword();
        
        extract($_POST, EXTR_SKIP);

        $password_corrente = md5($password_corrente);
        $nuova_password = md5($password);
        $password_ripetuta = md5($password_ripetuta);

        if ($password_corrente != $vecchia_password['Password']){
            array_push ( $error , "La <span xml:lang='en'>password</span> corrente non è esatta");
        };
        if ($nuova_password != $password_ripetuta || !$nuova_password) {
            array_push ( $error , "Le <span xml:lang='en'>password</span> nuove non combaciano");
        };
        if ($nuova_password == $vecchia_password['Password']){
            array_push ( $error , "La <span xml:lang='en'>password</span> nuova è uguale alla vecchia");
        }

        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/",$password)){
            array_push ( $error , "La <span xml:lang='en'>password</span> deve essere lunga almeno 8, contenere almeno un carattere maiuscolo, uno minuscolo ed un numero");
        }

        if (empty($error)) {
            $userController->user->password = $nuova_password;
            $userController->aggiornaPsw();
            $page->replaceTag('MODIFICA-PSW', (new \html\components\SuccessoModifica));
        }
        else{
            $page->replaceTag('MODIFICA-PSW', (new \html\components\formModificaPsw($userController->user,$error)));
        }
    }
    else{
        $page->replaceTag('MODIFICA-PSW', (new \html\components\formModificaPsw($userController->user,$error)));
    }

    $page->replaceTag('MODIFICA-INFO', '');

    $page->replaceTag('FOOTER', (new \html\components\footer));


    echo $page;