<?php
use model\BreadcrumbItem;

require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Load request's data
    extract($_GET, EXTR_SKIP);

    $userController=new \controllers\UserController();

    $_page= new \html\template('riepilogo');

    $_page->replaceTag('HEAD', (new \html\components\head));

    $_page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new model\BreadcrumbItem("/carrello.php","Carrello"),
        new model\BreadcrumbItem("/metodopagamento.php","Metodo di pagamento"),
        new model\BreadcrumbItem("#", "Inserisci dati di pagamento")
    );

    $_page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    $_page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));

    extract($_POST, EXTR_SKIP);

    $paypal = 'unchecked';
    $carta = 'unchecked';

    if (isset($_POST['submit'])) {
         $selected_radio = $_POST['metodopagamento'];

         if ($selected_radio == 'paypal') {
                $paypal = 'checked';
                $_page->replaceTag('INSERIMENTO-METODO-PAGAMENTO', (new \html\components\formPaypal()));

          }else if ($selected_radio == 'carta') {
                $carta = 'checked';
                $_page->replaceTag('INSERIMENTO-METODO-PAGAMENTO', (new \html\components\formCartaCredito()));

          }
    }


    $_page->replaceTag('FOOTER', (new \html\components\footer));

    echo $_page;