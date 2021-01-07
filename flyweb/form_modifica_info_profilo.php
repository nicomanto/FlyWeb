<?php
    use model\BreadcrumbItem;

    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $error=array();

    $userController= new \controllers\UserController();

    $page = new \html\template('modifica_info_profilo');

    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    $breadcrumb=array(
        new model\BreadcrumbItem("/datipersonali.php","Profilo"),
        new model\BreadcrumbItem("#","Modifica profilo")
    );

    $page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    $page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));

    $page->replaceTag('MODIFICA-PSW', '');

    if(isset($_POST['submit'])) {
        extract($_POST, EXTR_SKIP);

        //check param like js
        if(!preg_match("/^[A-Za-zÀ-ú\s]{2,30}$/",$nome)){
            array_push ( $error , "Campo Nome: permessi da 2 a 30 caratteri totali fra A-Z, a-z, lettere accentate e il carattere spazio");
        }

        if(preg_match("/^(\s)*$/",$nome)){
            array_push ( $error , "Campo Nome: deve contenere almeno delle lettere");
        }

        if(!preg_match("/^[A-Za-zÀ-ú\s]{2,30}$/",$cognome)){
            array_push ( $error , "Campo Cognome: permessi da 2 a 30 caratteri totali fra A-Z, a-z, lettere accentate e il carattere spazio");
        }

        if(preg_match("/^(\s)*$/",$cognome)){
            array_push ( $error , "Campo Cognome: deve contenere almeno delle lettere");
        }

        $data = new DateTime($data_nascita); // Your date of birth
        $today = new Datetime(date('Y-m-d'));
        $diff = $today->diff($data);

        if($diff->y<14){
            array_push ( $error , "Campo Data di nascita: devi avere almeno 14 anni per registrarti");
        }

        if(!preg_match("/^[\w@#-]{4,15}$/",$username)){
            array_push ( $error , "Campo <span xml:lang='en'>Username</span>: permessi da 4 a 30 caratteri totali fra A-Z, a-z, lettere accentate e il carattere spazio");
        }

        if(preg_match("/^([0-9]|_|@|#|-)*$/",$username)){
            array_push ( $error , "Campo <span xml:lang='en'>Username</span>: deve contenere almeno delle lettere");
        }

        if(!preg_match("/^(([\w.-]{4,20})+)@(([A-Za-z.]{4,20})+)\.([A-Za-z]{2,3})$/",$email)){
            array_push ( $error , "Campo <span xml:lang='en'>Email</span>: non è in un formato standard come esempio@esempio.com");
        }

        if(empty($error)){
            $userController->user->username = $username;
            $userController->user->email = $email;
            $userController->user->nome = $nome;
            $userController->user->cognome = $cognome;
            $userController->user->data_nascita = $data_nascita;
            $userController->aggiornaUtente();
            $page->replaceTag('MODIFICA-INFO', (new \html\components\SuccessoModifica));
        }
        else{
            $page->replaceTag('MODIFICA-INFO', (new \html\components\modificainfoprofilo($userController->user,$error)));
        }
    }else{
        $page->replaceTag('MODIFICA-INFO', (new \html\components\modificainfoprofilo($userController->user,$error)));
    }
  
    
    
    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;


