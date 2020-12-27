<?php
    use model\BreadcrumbItem;

    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

 

    $admController = new \controllers\AdmController();
    $userController= new \controllers\UserController();
    $reviews = $userController->getReviewUtente();

    $_page= new \html\template('profilo');

    
    $_page->replaceTag('HEAD', (new \html\components\head));

    
    $_page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new model\BreadcrumbItem("/datipersonali.php","Profilo"),
        new model\BreadcrumbItem("#","Recensioni effettuate")
    );

    $_page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));



    $_page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));


    if (empty($reviews)) {
        $_page->replaceTag('RECENSIONI-PROFILO', ("Non hai ancora lasciato nessuna recensione"));
        //dovrei fare un componente apposito per segnalare il non aver ancora lasciato recensioni?
    }
    else {
        $_page->replaceTag('RECENSIONI-PROFILO', (new \html\components\travelReviews($reviews)));
    }
    
    $_page->replaceTag('FOOTER', (new \html\components\footer));

    echo $_page;