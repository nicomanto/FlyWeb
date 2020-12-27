<?php

    use controllers\RouteController;
    use model\BreadcrumbItem;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::unloggedRoute();

    // Redirect to home if user's already logged in
    if ($_SESSION['logged'] == true) {
        header('location:/index.php');
        exit();
    }


    $error=array();

    // Loading signup template
    $page = new \html\template('signup');

    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));

    // Set nav menu
    $page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new model\BreadcrumbItem("#","Registrati")
    );

    $page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    // Set signup form
    //$page->replaceTag('SIGNUP_FORM', (new \html\components\signupForm));

    // Set footer
    $page->replaceTag('FOOTER', (new \html\components\footer));

    // Check is signup is attempted
    if(isset($_POST['signup'])) {

        $signupController = new \controllers\SignupController();

        $requiredParams = [
            'nome',
            'cognome',
            'data_nascita',
            'username',
            'email',
            'password',
            'password_ripetuta'
        ];

        //$missingParam = $signupController->getMissingParams($_POST, $requiredParams);

        /*if ($missingParam != '') {
            echo 'Param ' . $missingParam . ' is missing.';
            // TODO: do something instead of exiting
            exit();
        }*/

        // Load request's data
        extract($_POST, EXTR_SKIP);

        //check param like js
        if(!preg_match("/^[A-Za-zÀ-ú\s]{4,30}$/",$nome)){
            array_push ( $error , "Campo Nome: permessi da 4 a 30 caratteri totali fra A-Z, a-z, lettere accentate e il carattere spazio");
        }

        if(preg_match("/^(\s)*$/",$nome)){
            array_push ( $error , "Campo Nome: deve contenere almeno delle lettere");
        }

        if(!preg_match("/^[A-Za-zÀ-ú\s]{4,30}$/",$cognome)){
            echo preg_match("/^[A-Za-zÀ-ú\s]{4,30}$/",$cognome);
            array_push ( $error , "Campo Cognome: permessi da 4 a 30 caratteri totali fra A-Z, a-z, lettere accentate e il carattere spazio");
        }

        if(preg_match("/^(\s)*$/",$cognome)){
            array_push ( $error , "Campo Cognome: deve contenere almeno delle lettere");
        }

        if($data_nascita>date('Y-m-d')){
            array_push ( $error , "Campo Data di nascita: la data deve essere antecedente ad oggi");
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

        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/",$password)){
            array_push ( $error , "La <span xml:lang='en'>password</span> deve essere lunga almeno 8, contenere almeno un carattere maiuscolo, uno minuscolo ed un numero");
        }

        

        // Load hashed passwords
        $password = md5($password);
        $password_ripetuta = md5($password_ripetuta);

        // Check if given passwords correspond
        if ($password != $password_ripetuta) {
            //echo 'Le password inserite non corrispondono, riprova.';
            // TODO: do something instead of exiting

            array_push ( $error , "Le password inserite non corrispondono, riprova.");
            
            //exit();
        }
        
        // Check if a user with given username already exists
        $usernameExists = $signupController->checkUsernameExistence($username);
        if ($usernameExists) {
            //echo 'Un utente con username ' . $username . ' esiste già';

            array_push ( $error , "Un utente con username " . $username . " esiste già.");
            // TODO: do something instead of exiting
            //exit();
        }
        
        // Check if a user with given email already exists
        $emailExists = $signupController->checkEmailExistence($email);
        if ($emailExists) {
            //echo 'Un utente con la mail ' . $email . ' esiste gia\'';

            array_push ( $error , "Un utente con la mail " . $email . " esiste già.");
            // TODO: do something instead of exiting
            //exit();
        }

        if(empty($error)){
            $signupController->registerUser($username, $email, $password, $nome, $cognome, $data_nascita);
            $page->replaceTag('SIGNUP_FORM', (new \html\components\responseMessage("Registrazione avvenuta con successo, scegli il tuo primo volo!")));
        }
        else{
            $page->replaceTag('SIGNUP_FORM', (new \html\components\signupForm($error)));
        }
    }
    else{
        $page->replaceTag('SIGNUP_FORM', (new \html\components\signupForm($error)));
    }
    


    echo $page;