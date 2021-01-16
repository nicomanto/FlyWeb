<?php

    use controllers\RouteController;
    use controllers\UserController;
    use html\components\Breadcrumb;
    use html\components\Footer;
    use html\components\FormModificaPsw;
    use html\components\Head;
    use html\components\PrincipalMenu;
    use html\components\SuccessoModifica;
    use html\Template;
    use model\BreadcrumbItem;

    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');
    RouteController::loggedRoute();

    $error=array();
 
    $page = new Template('modifica_info_profilo');

    $page->replaceTag('HEAD', (new Head));

    $page->replaceTag('NAV-MENU', (new PrincipalMenu));

    $breadcrumb=array(
        new BreadcrumbItem("/datipersonali.php","Profilo"),
        new BreadcrumbItem("#","Modifica Password")
    );

    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    if(isset($_POST['submit'])) {

        $userController= new UserController();
        $vecchia_password = $userController->getPassword();
        
        extract($_POST, EXTR_SKIP);

        $password_corrente = md5($password_corrente);
        $nuova_password = md5($password);
        $password_ripetuta = md5($password_ripetuta);

        if ($password_corrente != $vecchia_password['Password']){
            array_push ( $error , "La <span lang='en'>password</span> corrente non è esatta");
        };
        if ($nuova_password != $password_ripetuta || !$nuova_password) {
            array_push ( $error , "Le <span lang='en'>password</span> nuove non combaciano");
        };
        if ($nuova_password == $vecchia_password['Password']){
            array_push ( $error , "La <span lang='en'>password</span> nuova è uguale alla vecchia");
        }

        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/",$password)){
            array_push ( $error , "La <span lang='en'>password</span> deve essere lunga almeno 8, contenere almeno un carattere maiuscolo, uno minuscolo ed un numero");
        }

        if (empty($error)) {
            $userController->user->password = $nuova_password;
            $userController->aggiornaPsw();
            $page->replaceTag('MODIFICA-PSW', (new SuccessoModifica));
        }
        else{
            $page->replaceTag('MODIFICA-PSW', (new FormModificaPsw($userController->user,$error)));
        }
    }
    else{
        $page->replaceTag('MODIFICA-PSW', (new FormModificaPsw($userController->user,$error)));
    }

    $page->replaceTag('MODIFICA-INFO', '');

    $page->replaceTag('ELIMINAZIONE', '');

    $page->replaceTag('FOOTER', (new Footer));


    echo $page;