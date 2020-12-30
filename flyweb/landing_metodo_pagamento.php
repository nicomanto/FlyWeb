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

    $_page->replaceTag('VIAGGI-DA-ACQUISTARE', '');

    $_page->replaceTag('INSERIMENTO-DATI', '');

    $_page->replaceTag('TOTALE', '');


    if (isset($_POST['submit'])) {
        // $selected_radio = $_POST['metodopagamento'];

         if ($_POST['metodopagamento'] == 'paypal') {
                $_page->replaceTag('INSERIMENTO-METODO-PAGAMENTO', (new \html\components\formPaypal()));

          }else if ($_POST['metodopagamento'] == 'carta') {
                $_page->replaceTag('INSERIMENTO-METODO-PAGAMENTO', (new \html\components\formCartaCredito()));

          }
    }


    $_page->replaceTag('FOOTER', (new \html\components\footer));

    echo $_page;