<?php

    use controllers\RouteController;
    use controllers\UserController;
    use html\components\Breadcrumb;
    use html\components\Footer;
    use html\components\Head;
    use html\components\PrincipalMenu;
    use html\components\ProfileReviews;
    use html\components\ProfiloMenu;
    use html\components\ResponseMessage;
    use html\Template;
    use model\BreadcrumbItem;

    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');
    RouteController::loggedRoute();

 
    $userController= new UserController();
    $reviews = $userController->getReviewUtente();

    $_page= new Template('profilo');

    
    $_page->replaceTag('HEAD', (new Head));

    
    $_page->replaceTag('NAV-MENU', (new PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new BreadcrumbItem("/datipersonali.php","Profilo"),
        new BreadcrumbItem("#","Recensioni effettuate")
    );

    $_page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));



    $_page->replaceTag('PROFILOMENU', (new ProfiloMenu));


    if (empty($reviews)) {
        $_page->replaceTag('RECENSIONI-PROFILO', new responseMessage("Non hai nessuna recensione per ora..."));
        //dovrei fare un componente apposito per segnalare il non aver ancora lasciato recensioni?
    }
    else {
        $_page->replaceTag('RECENSIONI-PROFILO', (new ProfileReviews($reviews)));
    }
    
    $_page->replaceTag('FOOTER', (new Footer));

    echo $_page;