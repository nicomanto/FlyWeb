<?php

    use controllers\RouteController;
    use controllers\UserController;
    use html\components\Breadcrumb;
    use html\components\Footer;
    use html\components\FormCartaCredito;
    use html\components\FormPaypal;
    use html\components\Head;
    use html\components\PrincipalMenu;
    use html\components\ProfiloMenu;
    use html\Template;
    use model\BreadcrumbItem;

    require_once('./autoload.php');
    RouteController::loggedRoute();

    // Load request's data
    extract($_GET, EXTR_SKIP);
  
    $userController=new UserController();

    $_page= new Template('procedura_acquisto');

    $_page->replaceTag('HEAD', (new Head));

    $_page->replaceTag('NAV-MENU', (new PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new BreadcrumbItem("./carrello.php","Carrello"),
        new BreadcrumbItem("./metodopagamento.php","Metodo di pagamento"),
        new BreadcrumbItem("#", "Inserisci dati di pagamento")
    );

    $_page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    $_page->replaceTag('PROFILOMENU', (new ProfiloMenu));

  


    $_page->replaceTag('VIAGGI-DA-ACQUISTARE', '');

    $_page->replaceTag('INSERIMENTO-DATI', '');

    $_page->replaceTag('TOTALE', '');
    
   
    if (!(isset($_POST['metodopagamento']))){
        $_POST['metodopagamento'] = $_SESSION['metodopagamento']; }
        $_SESSION['metodopagamento'] = $_POST['metodopagamento'] ;
    

    if(isset($_SESSION['metodopagamento'])){
        // $variabile=$_SESSION['metodopagamento'];
        // $_POST['metodopagamento'] = $variabile;
             if ($_SESSION['metodopagamento'] == 'paypal'){
                 $_page->replaceTag('INSERIMENTO-METODO-PAGAMENTO', (new FormPaypal()));
         }else if ($_SESSION['metodopagamento'] == 'carta'){
             $_page->replaceTag('INSERIMENTO-METODO-PAGAMENTO', (new FormCartaCredito()));
     }
 }

 $_SESSION['metodopagamento'] = $_POST['metodopagamento'] ;

    if ($_POST['metodopagamento'] == 'paypal') {
        $_page->replaceTag('INSERIMENTO-METODO-PAGAMENTO', (new FormPaypal()));
    }else if ($_POST['metodopagamento'] == 'carta'){
        $_page->replaceTag('INSERIMENTO-METODO-PAGAMENTO', (new FormCartaCredito()));}


        
    
    // };

 




    $_page->replaceTag('FOOTER', (new Footer));

    echo $_page;