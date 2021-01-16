<?php

	use controllers\RouteController;
	use controllers\UserController;
	use html\components\Breadcrumb;
	use html\components\Footer;
	use html\components\Head;
	use html\components\PrincipalMenu;
	use html\components\ProfiloMenu;
	use html\Template;
	use model\BreadcrumbItem;

	require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

	RouteController::loggedRoute();

	// Load request's data
	extract($_GET, EXTR_SKIP);

	
	$ordine['via'] = $_SESSION['fatturazione']['via'];
	$ordine['cap'] = $_SESSION['fatturazione']['cap'];
	$ordine['provincia'] = $_SESSION['fatturazione']['provincia'];
	$ordine['comune'] = $_SESSION['fatturazione']['comune'];
	$ordine['metodopagamento'] = $_SESSION['metodopagamento'];
	$ordine['totale'] = $_SESSION['totale'];

	$userController = new UserController();

	$items = $userController->getViaggiCarrello();

	$_page = new Template('riepilogo_ordine');

	$_page->replaceTag('HEAD', (new Head));

	$_page->replaceTag('NAV-MENU', (new PrincipalMenu));

	// Set breadcrumb
	$breadcrumb = array(
		new BreadcrumbItem("./carrello.php", "Carrello"),
		new BreadcrumbItem("./metodopagamento.php", "Metodo di pagamento"),
		new BreadcrumbItem("./landing_metodo_pagamento.php", "Inserisci dati di pagamento"),
		new BreadcrumbItem("./dati_fatturazione.php", "Inserisci dati di fatturazione"),
		new BreadcrumbItem("./landing_riepilogo.php", "Riepilogo ordine"),
		new BreadcrumbItem("#", "Ordine confermato")
	);

	$_page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

	$_page->replaceTag('PROFILOMENU', (new ProfiloMenu));

	extract($_POST, EXTR_SKIP);

	$userController->addOrder($ordine);

	$userController->addViaggiOrdine($userController->getID_Order(), $userController->getIDViaggiCarrello());
	$userController->eliminaCarrello($userController->getID_Carrello());

	$_page->replaceTag('DATI-INSERITI', '');

	$_page->replaceTag('VIAGGI', '');
    $_page->replaceTag('SUCCESSO', new \html\components\responseMessage("Complimenti acquisto completato, ora rilassati e goditi il viaggio!"));

	$_page->replaceTag('TOTALE', '');

	$_page->replaceTag('FOOTER', (new Footer));

	echo $_page;
