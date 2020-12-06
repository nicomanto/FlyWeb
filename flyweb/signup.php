<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Redirect to home if user's already logged in
    if ($_SESSION['logged'] == true) {
        header('location:index.php');
        exit();
    }

    // Loading signup template
    $page = new \html\template('signup');

    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));

    // Set nav menu
    $page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    // Set signup form
    $page->replaceTag('SIGNUP_FORM', (new \html\components\signupForm));

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

        $missingParam = $signupController->getMissingParams($_POST, $requiredParams);

        if ($missingParam != '') {
            echo 'Param ' . $missingParam . ' is missing.';
            // TODO: do something instead of exiting
            exit();
        }

        // Load request's data
        extract($_POST, EXTR_SKIP);


        // Load hashed passwords
        $password = md5($password);
        $password_ripetuta = md5($password_ripetuta);


        // Check if given passwords correspond
        if ($password != $password_ripetuta) {
            echo 'Le password inserite non corrispondono, riprova.';
            // TODO: do something instead of exiting
            exit();
        }
        
        // Check if a user with given username already exists
        $usernameExists = $signupController->checkUsernameExistence($username);
        if ($usernameExists) {
            echo 'Un utente con username ' . $username . ' esiste gia\'';
            // TODO: do something instead of exiting
            exit();
        }
        
        // Check if a user with given email already exists
        $emailExists = $signupController->checkEmailExistence($email);
        if ($emailExists) {
            echo 'Un utente con la mail ' . $email . ' esiste gia\'';
            // TODO: do something instead of exiting
            exit();
        }

        $signupController->registerUser($username, $email, $password, $nome, $cognome, $data_nascita);
        
    }


    echo $page;