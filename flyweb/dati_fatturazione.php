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
	use html\Template;
	use model\BreadcrumbItem;

	require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');


	// Load request's data
	extract($_GET, EXTR_SKIP);
	extract($_POST, EXTR_SKIP);

	$userController = new UserController();

	$_SESSION['metodopagamento'] = $_POST['metodopagamento'];
	echo ($_SESSION['metodopagamento']);
	$_page= new Template('procedura_acquisto');

	$_page->replaceTag('HEAD', (new Head));

	$_page->replaceTag('NAV-MENU', (new PrincipalMenu));

	// Set breadcrumb
	$breadcrumb = array(
		new BreadcrumbItem("/carrello.php", "Carrello"),
		new BreadcrumbItem("/metodopagamento.php", "Metodo di pagamento"),
		new BreadcrumbItem("/landing_metodo_pagamento.php", "Inserisci dati di pagamento"),
		new BreadcrumbItem("#", "Inserisci dati di fatturazione")
	);

	$_page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));
	$_page->replaceTag('PROFILOMENU', (new ProfiloMenu));

	if(isset($_SESSION['fatturazione'])){
		$mario=$_SESSION['fatturazione'];
		$_page->replaceTag('INSERIMENTO-DATI', (new \html\components\FormInserimentoDatiFatturazione($mario)));
	  }else{
		$_page->replaceTag('INSERIMENTO-DATI', (new \html\components\FormInserimentoDatiFatturazione()));
	  }

	if ($_POST['metodopagamento'] != 'paypal') {
		if (!preg_match("/^[A-Za-zÀ-ú\s]{2,30}$/", $_POST['titolareCarta'])) {
			$_page->replaceTag('INSERIMENTO-DATI', (new ResponseMessage('Errore inserimento titolare carta: permessi da 2 a 30 caratteri totali fra A-Z, a-z, lettere accentate e il carattere spazio, riprova...', "./metodopagamento.php", "Seleziona metodo di pagamento", false)));
		} else if (preg_match("/^(\s)*$/", $_POST['titolareCarta'])) {
			array_push($error, "Errore inserimento titolare carta: deve contenere almeno delle lettere");
			$_page->replaceTag('INSERIMENTO-DATI', (new ResponseMessage('Errore inserimento titolare carta: deve contenere almeno delle lettere, riprova...', "./metodopagamento.php", "Seleziona metodo di pagamento", false)));
		} else if (strlen($_POST['codiceCarta']) < 13 || strlen($_POST['codiceCarta']) > 16) {
			$_page->replaceTag('INSERIMENTO-DATI', (new ResponseMessage('Errore: La carta di credito è formata da 13 a 16 numeri, riprova...', "./metodopagamento.php", "Seleziona metodo di pagamento", false)));
		} else if ($_POST['scadenza_mese'] > 12 || $_POST['scadenza_mese'] < 1) {
			$_page->replaceTag('INSERIMENTO-DATI', (new ResponseMessage('Errore: Il mese di scadenza deve essere compreso fra 1 e 12, riprova...', "./metodopagamento.php", "Seleziona metodo di pagamento", false)));
		} else if (strlen($_POST['scadenza_mese']) > 2) {
			$_page->replaceTag('INSERIMENTO-DATI', (new ResponseMessage('Errore: Il mese di scadenza deve avere al massimo due cifre (es. 01 o 1 per Gennaio), riprova...', "./metodopagamento.php", "Seleziona metodo di pagamento", false)));
		} else if ($_POST['scadenza_anno'] < 0) {
			$_page->replaceTag('INSERIMENTO-DATI', (new ResponseMessage('Errore: L\'anno di scadenza deve essere positivo, riprova...', "./metodopagamento.php", "Seleziona metodo di pagamento", false)));
		} else if (strlen($_POST['scadenza_anno']) > 2) {
			$_page->replaceTag('INSERIMENTO-DATI', (new ResponseMessage('Errore: L\'anno di scadenza deve avere al massimo due cifre (es. 21 per 2021), riprova...', "./metodopagamento.php", "Seleziona metodo di pagamento", false)));
		} else if (strlen($_POST['cvv']) > 3) {
			$_page->replaceTag('INSERIMENTO-DATI', (new ResponseMessage('Errore: Il codice CVV deve avere al massimo 3 cifre, riprova...', "./metodopagamento.php", "Seleziona metodo di pagamento", false)));
		} else {
			//$_page->replaceTag('INSERIMENTO-DATI', (new FormInserimentoDatiFatturazione()));
		}
	} else {
		if (!preg_match("/^(([\w.-]{4,20})+)@(([A-Za-z.]{4,20})+)\.([A-Za-z]{2,3})$/", $_POST['email'])) {
			$_page->replaceTag('INSERIMENTO-DATI', (new ResponseMessage('Errore inserimento <span xml:lang=\'en\'>email</span> paypal: non è in un formato standard come esempio@esempio.com, riprova...', "./metodopagamento.php", "Seleziona metodo di pagamento", false)));
		} else {
			//$_page->replaceTag('INSERIMENTO-DATI', (new FormInserimentoDatiFatturazione()));
		}
	}

	$_page->replaceTag('VIAGGI-DA-ACQUISTARE', '');

	$_page->replaceTag('INSERIMENTO-METODO-PAGAMENTO', '');

	$_page->replaceTag('FOOTER', (new Footer));

	echo $_page;
