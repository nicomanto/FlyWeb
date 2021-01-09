<?php

use controllers\RouteController;
use controllers\UserController;
    use html\components\Breadcrumb;
    use html\components\Footer;
    use html\components\FormInserimentoDatiFatturazione;
    use html\components\Head;
    use html\components\PrincipalMenu;
    use html\components\ProfiloMenu;
    use html\components\ResponseMessage;
    use html\components\RiepilogoOrdine;
    use html\components\Totale;
    use html\components\TravelOrder;
    use html\Template;
    use model\BreadcrumbItem;

    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');
    RouteController::loggedRoute();

    // Load request's data
    extract($_GET, EXTR_SKIP);

    $userController=new UserController();

    $items = $userController->getViaggiCarrello(); 

    $risultato=$userController->getSubtotale();

    $_page= new Template('riepilogo_ordine');

    $_page->replaceTag('HEAD', (new Head));

    $_page->replaceTag('NAV-MENU', (new PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
      new BreadcrumbItem("/carrello.php","Carrello"),
      new BreadcrumbItem("/metodopagamento.php","Metodo di pagamento"),
      new BreadcrumbItem("/landing_metodo_pagamento.php", "Inserisci dati di pagamento"),
      new BreadcrumbItem("/dati_fatturazione.php","Inserisci dati di fatturazione"),
      new BreadcrumbItem("#", "Riepilogo ordine")
    );

    $_page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    $_page->replaceTag('PROFILOMENU', (new ProfiloMenu));

    
    $searchResults = '';
    foreach ($items as $li) {
        $searchResults .= new TravelOrder($li);
    }

    extract($_POST, EXTR_SKIP);

    $form1 = new FormInserimentoDatiFatturazione();
    $fatturazione = $form1->estraiDatiFatturazione();


    if(!preg_match("/^[\w\s\.]*$/",$fatturazione['via'])){
      $_page->replaceTag('DATI-INSERITI', (new ResponseMessage('Campo via: permessi i caratteri da A-Z, a-z, 0-9, _ e il carattere spazio, riprova...',"./metodopagamento.php","Seleziona metodo di pagamento",false)));
      $_page->replaceTag('VIAGGI', '');
      $_page->replaceTag('TOTALE', '');
    }
    else if(preg_match("/^(\.|_|\s)*$/",$fatturazione['via'])){
      $_page->replaceTag('DATI-INSERITI', (new ResponseMessage('Campo via: deve contenere almeno delle lettere o numeri, riprova...',"./metodopagamento.php","Seleziona metodo di pagamento",false)));
      $_page->replaceTag('VIAGGI', '');
      $_page->replaceTag('TOTALE', '');
    }
    else if(!preg_match("/^[\w\s\.]*$/",$fatturazione['comune'])){
      $_page->replaceTag('DATI-INSERITI', (new ResponseMessage('Campo comune: permessi i caratteri da A-Z, a-z, 0-9, _ e il carattere spazio, riprova...',"./metodopagamento.php","Seleziona metodo di pagamento",false)));
      $_page->replaceTag('VIAGGI', '');
      $_page->replaceTag('TOTALE', '');
    }
    else if(preg_match("/^(\.|_|\s)*$/",$fatturazione['comune'])){
      $_page->replaceTag('DATI-INSERITI', (new ResponseMessage('Campo comune: deve contenere almeno delle lettere o numeri, riprova...',"./metodopagamento.php","Seleziona metodo di pagamento",false)));
      $_page->replaceTag('VIAGGI', '');
      $_page->replaceTag('TOTALE', '');
    }
    else if(!preg_match("/^[\w\s\.]*$/",$fatturazione['provincia'])){
      $_page->replaceTag('DATI-INSERITI', (new ResponseMessage('Campo provincia: permessi i caratteri da A-Z, a-z, 0-9, _ e il carattere spazio, riprova...',"./metodopagamento.php","Seleziona metodo di pagamento",false)));
      $_page->replaceTag('VIAGGI', '');
      $_page->replaceTag('TOTALE', '');
    }
    else if(preg_match("/^(\.|_|\s)*$/",$fatturazione['provincia'])){
      $_page->replaceTag('DATI-INSERITI', (new ResponseMessage('Campo provincia: deve contenere almeno delle lettere o numeri, riprova...',"./metodopagamento.php","Seleziona metodo di pagamento",false)));
      $_page->replaceTag('VIAGGI', '');
      $_page->replaceTag('TOTALE', '');
    }
    else if(!preg_match("/^[\d]{5}$/",$fatturazione['cap'])){
      $_page->replaceTag('DATI-INSERITI', (new ResponseMessage('Campo CAP: Si devono inserire 5 numeri, riprova...',"./metodopagamento.php","Seleziona metodo di pagamento",false)));
      $_page->replaceTag('VIAGGI', '');
      $_page->replaceTag('TOTALE', '');
    }
    else{
      $_page->replaceTag('DATI-INSERITI', (new RiepilogoOrdine($fatturazione)));

      $_page->replaceTag('VIAGGI', $searchResults);

      $_page->replaceTag('TOTALE', (new Totale($risultato)));
      
      $fatturazione['totale'] = $risultato;

      $prova= $userController->ordineTemporaneo($fatturazione);
    }

    $_page->replaceTag('FOOTER', (new Footer));

    $_page->replaceTag('SUCCESSO', '');


    echo $_page;