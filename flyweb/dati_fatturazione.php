<?php
use model\BreadcrumbItem;

require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Load request's data
    extract($_POST, EXTR_SKIP);

    $_SESSION['metodopagamento'] = $_POST['metodopagamento'];

    $userController=new \controllers\UserController();

    $_page= new \html\template('procedura_acquisto');

    $_page->replaceTag('HEAD', (new \html\components\head));

    $_page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new model\BreadcrumbItem("/carrello.php","Carrello"),
        new model\BreadcrumbItem("/metodopagamento.php","Metodo di pagamento"),
        new model\BreadcrumbItem("/landing_metodo_pagamento.php", "Inserisci dati di pagamento"),
        new model\BreadcrumbItem("#","Inserisci dati di fatturazione")
    );

    $_page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    $_page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));

  if(isset($_SESSION['fatturazione'])){
    $mario=$_SESSION['fatturazione'];
    $_page->replaceTag('INSERIMENTO-DATI', (new \html\components\FormInserimentoDatiFatturazione($mario)));
  }else{
    $_page->replaceTag('INSERIMENTO-DATI', (new \html\components\FormInserimentoDatiFatturazione()));
  }
    $_page->replaceTag('VIAGGI-DA-ACQUISTARE', '');

    $_page->replaceTag('INSERIMENTO-METODO-PAGAMENTO', '');

    $_page->replaceTag('TOTALE', '');

    $_page->replaceTag('FOOTER', (new \html\components\footer));

    echo $_page;