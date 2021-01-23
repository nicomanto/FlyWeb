<?php

    use controllers\RouteController;
    use controllers\SignupController;
    use html\components\Breadcrumb;
    use html\components\Footer;
    use html\components\Head;
    use html\components\PrincipalMenu;
    use html\components\ResponseMessage;
    use html\components\SignupForm;
    use html\Template;
    use model\BreadcrumbItem;

    require_once('./autoload.php');

    RouteController::unloggedRoute();

    // Redirect to home if user's already logged in
    if ($_SESSION['logged'] == true) {
        header('location:./index.php');
        exit();
    }


    $error=array();

    // Loading signup template
    $page = new Template('signup');

    // Set page head
    $page->replaceTag('HEAD', (new Head));

    // Set nav menu
    $page->replaceTag('NAV-MENU', (new PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new BreadcrumbItem("#","Registrati")
    );

    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    // Set signup form
    //$page->replaceTag('SIGNUP_FORM', (new SignupForm));

    // Set footer
    $page->replaceTag('FOOTER', (new Footer));

    // Check is signup is attempted
    if(isset($_POST['signup'])) {

        $signupController = new SignupController();

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
        if(!preg_match("/^[A-Za-zÀ-ú\s]{2,30}$/",$nome)){
            array_push ( $error , "Campo Nome: permessi da 2 a 30 caratteri totali fra A-Z, a-z, lettere accentate e il carattere spazio");
        }

        if(preg_match("/^(\s)*$/",$nome)){
            array_push ( $error , "Campo Nome: deve contenere almeno delle lettere");
        }

        if(!preg_match("/^[A-Za-zÀ-ú\s]{2,30}$/",$cognome)){
            echo preg_match("/^[A-Za-zÀ-ú\s]{4,30}$/",$cognome);
            array_push ( $error , "Campo Cognome: permessi da 2 a 30 caratteri totali fra A-Z, a-z, lettere accentate e il carattere spazio");
        }

        if(preg_match("/^(\s)*$/",$cognome)){
            array_push ( $error , "Campo Cognome: deve contenere almeno delle lettere");
        }

        


        if(!preg_match("/(^(((0[1-9]|1[0-9]|2[0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)/",$data_nascita)){
            array_push ( $error , "Campo Data di nascita: non è scritto nel formato richiesto");
        }
        else{
            /*Reverse date*/
            if(strpos($data_nascita, '/') !== false){
                $data=explode( '/', $data_nascita );
                $data= array_reverse($data);
                $data_nascita="";
                
                foreach($data as $i){
                    $data_nascita.=$i.'-';
                }

                $data_nascita=rtrim($data_nascita, '-');
            }
            $data = new DateTime($data_nascita); // Your date of birth
            $today = new Datetime(date('Y-m-d'));
            $diff = $today->diff($data);

            if($diff->y<14){
                array_push ( $error , "Campo Data di nascita: devi avere almeno 14 anni per registrarti");
            }
        }
        
        

        if(!preg_match("/^[\w@#-]{4,15}$/",$username)){
            array_push ( $error , "Campo <span lang='en'>Username</span>: permessi da 4 a 30 caratteri totali fra A-Z, a-z, lettere accentate e il carattere spazio");
        }

        if(preg_match("/^([0-9]|_|@|#|-)*$/",$username)){
            array_push ( $error , "Campo <span lang='en'>Username</span>: deve contenere almeno delle lettere");
        }

        if(!preg_match("/^(([\w.-]{4,20})+)@(([A-Za-z.]{4,20})+)\.([A-Za-z]{2,3})$/",$email)){
            array_push ( $error , "Campo <span lang='en'>Email</span>: non è in un formato standard come esempio@esempio.com");
        }

        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/",$password)){
            array_push ( $error , "La <span lang='en'>password</span> deve essere lunga almeno 8, contenere almeno un carattere maiuscolo, uno minuscolo ed un numero");
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
            $page->replaceTag('SIGNUP_FORM', (new ResponseMessage("Registrazione avvenuta con successo, scegli il tuo primo viaggio!","./login.php","Accedi",false)));
        }
        else{
            $page->replaceTag('SIGNUP_FORM', (new SignupForm($error)));
        }
    }
    else{
        $page->replaceTag('SIGNUP_FORM', (new SignupForm($error)));
    }
    


    echo $page;