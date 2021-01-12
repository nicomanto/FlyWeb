<?php

    use \model\BreadcrumbItem;
    use \controllers\reviewController;
    use \model\Review;
    use \controllers\UserController;

    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $userController= new \controllers\UserController();

    if($_SESSION['logged_in'] == false){
        header('location:/index.php');
        exit();
    }

    // Load request's data
    extract($_GET, EXTR_SKIP);
    extract($_POST, EXTR_SKIP);
    $error=array();

    //print_r($_GET);

    $_page = new \html\template('inserimento_recensione');

    $_page->replaceTag('HEAD', (new \html\components\head));

    $_page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    $breadcrumb=array(
        new model\BreadcrumbItem("/datipersonali.php","Profilo"),
        new model\BreadcrumbItem("/ordiniprofilo.php","Ordini effettuati"),
        new model\BreadcrumbItem("#", "Inserire recensione"),
    );

    $_page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    

    if(!$_POST['btn_approva']){

        $review = new \model\Review($_POST['titolo'],(int)$_POST['valutazione'],$_POST['descrizione'],(int)$userController->user->id_utente,$_POST['lingua']);

        //check param like js
        if(!preg_match("/^[\w\s\.]*$/",$review->titolo)){
            array_push ( $error , "Campo Titolo: Permessi i caratteri da A-Z, a-z, 0-9, _ e il carattere spazio");
        }

        if(preg_match("/^(\.|_|\s)*$/",$review->titolo)){
            array_push ( $error , "Campo Titolo: deve contenere almeno delle lettere o numeri");
        }

        if(!preg_match("/^[\w\s\.]*$/",$review->descrizione)){
            array_push ( $error , "Campo Descrizione: Permessi i caratteri da A-Z, a-z, 0-9, _ e il carattere spazio");
        }

        if(preg_match("/^(\.|_|\s)*$/",$review->descrizione)){
            array_push ( $error , "Campo Descrizione: deve contenere almeno delle lettere o numeri");
        }

        if($review->valutazione<0 || $review->valutazione>5){
            array_push ( $error , "Campo Valutazione: deve essere compresa fra 0 e 5");
        }


        if(empty($error)){
            (new \controllers\ReviewController())->insertReview($review,$_POST['id_viaggio']);
            $_page->replaceTag('FORM_RECENSIONE', (new \html\components\responseMessage("Recensione inserita con successo, grazie!")));
        }
        else{
            $_page->replaceTag('FORM_RECENSIONE', new \html\components\formInsertReview($error,(int)$_POST['id_viaggio']));
        }
        
    }
    else{
        $_page->replaceTag('FORM_RECENSIONE', new \html\components\formInsertReview($error,(int)$_POST['id_viaggio']));
    }
    

    $_page->replaceTag('FOOTER', (new \html\components\footer));

    echo $_page;