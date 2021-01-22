<?php

    use controllers\RouteController;
    use controllers\LoginController;
    use html\components\Breadcrumb;
    use html\components\Footer;
    use html\components\Head;
    use html\components\LoginForm;
    use html\components\PrincipalMenu;
    use html\Template;
    use model\BreadcrumbItem;

    require_once('./autoload.php');

    RouteController::unloggedRoute();

    // Redirect to home if user's already logged in
    if($_SESSION['logged_in'] == true){
        header('location:./index.php');
        exit();
    }

    $error=array();

    // Check if login is attempted
    if(isset($_POST['login'])) {
        $loginController = new LoginController();

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
        $no_crip_pass=$password;
        $password = md5($password);
        
        $userExists = $loginController->checkUserExistence($user);

        if (!$userExists) {
            // TODO: For debug only
            //echo 'L\'utente ' . $user . ' non esiste nel database';
            // TODO: do something instead of exiting
            //exit();

            array_push ( $error , "L'utente " . $user . " non è registrato nel sito.");
        }
        else{

            $loggedIn = $loginController->checkUserAuth($user, $password);

            if (!$loggedIn) {
                // TODO: For debug only
                //echo 'La password ' . $password . ' non e\' corretta per l\'utente ' . $user;
                // TODO: do something instead of exiting
                //exit();

                array_push ( $error , "La password immessa non è corretta per l'utente \"". $user . "\"");
            }
            else{
                $_SESSION['logged_in'] = true;
                $_SESSION['ID_Utente'] = $loggedIn['ID_Utente'];
    
                if ($loggedIn['Admin']) {
                    // Redirect to Administration page
                    $_SESSION['admin'] = true;

                    unset($_SESSION['redirect_uri']);
                    unset($_SESSION['redirect_body']);

                    // Redirect to admin home
                    header('location:./adm_index.php');
                } else {
                    $_SESSION['admin'] = false;

                    // Check if redirection is needed
                    if (!empty($_SESSION['redirect_uri'])) {
                        // redirect to previously requested page
                        header('location:' . $_SESSION['redirect_uri']);
                    } else {
                        // Redirect to home page
                        header('location:./index.php');
                    }
                }
    
                exit();
            }

        }

    }

    // Loading login template
    $page = new Template('login');
    
    // Set page head
    $page->replaceTag('HEAD', (new Head));

    // Set nav menu
    $page->replaceTag('NAV-MENU', (new PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new BreadcrumbItem("#","Accedi")
    );

    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));
    
    // Set login form
    $page->replaceTag('LOGIN_FORM', (new LoginForm($error)));

    // Set footer
    $page->replaceTag('FOOTER', (new Footer));

    echo $page;