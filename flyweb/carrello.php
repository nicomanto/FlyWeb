<?php
use model\BreadcrumbItem;
use model\Paginator;

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

    $page = isset($page) ? $page : 1;

    $items = $userController->getViaggiCarrello();

    $paginatedViaggiCarrello = Paginator::paginate($items, $page);

    $_page= new \html\template('carrello');

    $_page->replaceTag('HEAD', (new \html\components\head));

    $_page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new model\BreadcrumbItem("#","Carrello")
    );

    $_page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    $_page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));


    $results = '';
    
    foreach ($paginatedViaggiCarrello['elements'] as $viaggio) {
        $results .= new \html\components\carrelloElementi($viaggio);
    }

    if (empty($results)) {
        $_page->replaceTag('CONTENUTO-CARRELLO', (new \html\components\responseMessage("Il tuo carrello è vuoto")));
        $_page->replaceTag('PAGE_SELECTOR', ' ');

    }

    else {
        $_page->replaceTag('CONTENUTO-CARRELLO', $results);
        $_page->replaceTag('PAGE_SELECTOR', (new \html\components\pageSelector($paginatedViaggiCarrello)));
        $_page->replaceTag('SUB-TOTALE',new \html\components\subtotale($userController->getSubtotale()));

    }


    //$_page->replaceTag('SUB-TOTALE', (new \html\components\subtotale) );
   // $_page->replaceTag('SUB-TOTALE',new \html\components\subtotale($userController->getSubtotale()));

    $_page->replaceTag('FOOTER', (new \html\components\footer));

    echo $_page;