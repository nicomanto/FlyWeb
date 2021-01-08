<?php
use model\BreadcrumbItem;

require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Load request's data
    extract($_GET, EXTR_SKIP);

    $userController=new \controllers\UserController();

    $items = $userController->getViaggiCarrello(); 

    $risultato=$userController->getSubtotale();

    $_page= new \html\template('riepilogo_ordine');

    $_page->replaceTag('HEAD', (new \html\components\head));

    $_page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
      new model\BreadcrumbItem("/carrello.php","Carrello"),
      new model\BreadcrumbItem("/metodopagamento.php","Metodo di pagamento"),
      new model\BreadcrumbItem("/landing_metodo_pagamento.php", "Inserisci dati di pagamento"),
      new model\BreadcrumbItem("/dati_fatturazione.php","Inserisci dati di fatturazione"),
      new model\BreadcrumbItem("#", "Riepilogo ordine")
    );

    $_page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    $_page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));

    
    $searchResults = '';
    foreach ($items as $li) {
        $searchResults .= new \html\components\travelOrder($li);
    }

    extract($_POST, EXTR_SKIP);

    $form1 = new \html\components\FormInserimentoDatiFatturazione();
    $fatturazione = $form1->estraiDatiFatturazione();


    if(!preg_match("/^[\w\s\.]*$/",$fatturazione['via'])){
      $_page->replaceTag('DATI-INSERITI', (new \html\components\responseMessage('Campo via: permessi i caratteri da A-Z, a-z, 0-9, _ e il carattere spazio, riprova...',"./metodopagamento.php","Seleziona metodo di pagamento",false)));
      $_page->replaceTag('VIAGGI', '');
      $_page->replaceTag('TOTALE', '');
    }
    else if(preg_match("/^(\.|_|\s)*$/",$fatturazione['via'])){
      $_page->replaceTag('DATI-INSERITI', (new \html\components\responseMessage('Campo via: deve contenere almeno delle lettere o numeri, riprova...',"./metodopagamento.php","Seleziona metodo di pagamento",false)));
      $_page->replaceTag('VIAGGI', '');
      $_page->replaceTag('TOTALE', '');
    }
    else if(!preg_match("/^[\w\s\.]*$/",$fatturazione['comune'])){
      $_page->replaceTag('DATI-INSERITI', (new \html\components\responseMessage('Campo comune: permessi i caratteri da A-Z, a-z, 0-9, _ e il carattere spazio, riprova...',"./metodopagamento.php","Seleziona metodo di pagamento",false)));
      $_page->replaceTag('VIAGGI', '');
      $_page->replaceTag('TOTALE', '');
    }
    else if(preg_match("/^(\.|_|\s)*$/",$fatturazione['comune'])){
      $_page->replaceTag('DATI-INSERITI', (new \html\components\responseMessage('Campo comune: deve contenere almeno delle lettere o numeri, riprova...',"./metodopagamento.php","Seleziona metodo di pagamento",false)));
      $_page->replaceTag('VIAGGI', '');
      $_page->replaceTag('TOTALE', '');
    }
    else if(!preg_match("/^[\w\s\.]*$/",$fatturazione['provincia'])){
      $_page->replaceTag('DATI-INSERITI', (new \html\components\responseMessage('Campo provincia: permessi i caratteri da A-Z, a-z, 0-9, _ e il carattere spazio, riprova...',"./metodopagamento.php","Seleziona metodo di pagamento",false)));
      $_page->replaceTag('VIAGGI', '');
      $_page->replaceTag('TOTALE', '');
    }
    else if(preg_match("/^(\.|_|\s)*$/",$fatturazione['provincia'])){
      $_page->replaceTag('DATI-INSERITI', (new \html\components\responseMessage('Campo provincia: deve contenere almeno delle lettere o numeri, riprova...',"./metodopagamento.php","Seleziona metodo di pagamento",false)));
      $_page->replaceTag('VIAGGI', '');
      $_page->replaceTag('TOTALE', '');
    }
    else if(!preg_match("/^[\d]{5}$/",$fatturazione['cap'])){
      $_page->replaceTag('DATI-INSERITI', (new \html\components\responseMessage('Campo CAP: Si devono inserire 5 numeri, riprova...',"./metodopagamento.php","Seleziona metodo di pagamento",false)));
      $_page->replaceTag('VIAGGI', '');
      $_page->replaceTag('TOTALE', '');
    }
    else{
      $_page->replaceTag('DATI-INSERITI', (new \html\components\RiepilogoOrdine($fatturazione)));

      $_page->replaceTag('VIAGGI', $searchResults);

      $_page->replaceTag('TOTALE', (new \html\components\Totale($risultato)));
      
      $fatturazione['totale'] = $risultato;

      $prova= $userController->ordineTemporaneo($fatturazione);
    }

    $_page->replaceTag('FOOTER', (new \html\components\footer));

    $_page->replaceTag('SUCCESSO', '');

    echo $_page;