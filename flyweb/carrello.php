<?php
use model\BreadcrumbItem;

require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Load request's data
    extract($_GET, EXTR_SKIP);

    $userController= new \controllers\UserController();

    $items = $userController->getViaggiCarrello();

    if(!empty($_POST)){
        if($_POST['btn_elimina']){
            $userController->deleteViaggioCarrello();
        }
    }

    $_page= new \html\template('carrello');

    $_page->replaceTag('HEAD', (new \html\components\head));

    $_page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new model\BreadcrumbItem("/datipersonali.php","Profilo"),
        new model\BreadcrumbItem("#","Ordini effettuati")
    );

    $_page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    $_page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));

    
    $searchResults = '';
    foreach ($items as $li) {
        $searchResults .= new \html\components\carrelloElementi($li);
    }

    if (empty($searchResults)) {
        $_page->replaceTag('CONTENUTO-CARRELLO', ("Il tuo carrello è vuoto"));
    }

    else {
        $_page->replaceTag('CONTENUTO-CARRELLO', $searchResults);
    }

    $_page->replaceTag('FOOTER', (new \html\components\footer));

    echo $_page;