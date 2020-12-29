<?php
use model\BreadcrumbItem;

require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Load request's data
    extract($_GET, EXTR_SKIP);

    $userController=new \controllers\UserController();
    
    extract($_POST, EXTR_SKIP);

    if(!empty($_POST)){
        if($_POST['btn_elimina']){
            $userController->deleteViaggioCarrello($id_viaggio);
        }
    }


    $items = $userController->getViaggiCarrello();
    
    $_page= new \html\template('carrello');

    $_page->replaceTag('HEAD', (new \html\components\head));

    $_page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new model\BreadcrumbItem("#","Carrello")
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


    //$_page->replaceTag('SUB-TOTALE', (new \html\components\subtotale) );
    $_page->replaceTag('SUB-TOTALE',new \html\components\subtotale($userController->getSubtotale()));

    $_page->replaceTag('FOOTER', (new \html\components\footer));

    echo $_page;