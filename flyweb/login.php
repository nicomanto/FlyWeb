<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Redirect to home if user's already logged in
    if($_SESSION['logged_in'] == true){
        header('location:index.php');
        exit();
    }

    // Check if login is attempted
    if(isset($_POST['login'])) {
        $loginController = new \controllers\LoginController();

        $requiredParams = [
            'user',
            'password'
        ];

        $missingParam = $loginController->getMissingParams($_POST, $requiredParams);

        if ($missingParam != '') {
            echo 'Param ' . $missingParam . ' is missing';
            // TODO: do something instead of exiting
            exit();
        }

        // Load request's data
        extract($_POST, EXTR_SKIP);

        // Hash password
        $password = md5($password);
        
        $userExists = $loginController->checkUserExistence($user);

        if (!$userExists) {
            // TODO: For debug only
            echo 'L\'utente ' . $user . ' non esiste nel database';
            // TODO: do something instead of exiting
            exit();
        }

        $passwordIsCorrect = $loginController->checkUserAuth($user, $password);

        if (!$passwordIsCorrect) {
            // TODO: For debug only
            echo 'La password ' . $password . ' non e\' corretta per l\'utente ' . $user;
            // TODO: do something instead of exiting
            exit();
        }

        $loggedIn = $loginController->checkUserAuth($user, $password);
        if ($loggedIn) {
            // Persist login on this session
            $_SESSION['logged_in'] = true;

            // Set cookie for future sessions
            // TODO: Check if users agreed for cookies
            setcookie('flw_user', $user);
            // TODO: Set to a temp hashed random string stored in db?
            setcookie('flw_password', $password, time() + 60 * 60 * 24 * 30);

            // Redirect to home page
            header('location:index.php');
            exit();
        } else {
            echo 'Wrong credentials';
            // TODO: Do something instead of exiting
            exit();
        }



    }

    // Loading login template
    $page = new \html\template('login');
    
    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));

    // Set nav menu
    $page->replaceTag('NAV-MENU', (new \html\components\NavMenu));
    
    // Set login form
    $page->replaceTag('LOGIN_FORM', (new \html\components\loginForm));

    echo $page;