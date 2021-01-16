<?php

    use controllers\RouteController;
    use controllers\UserController;
    use html\components\Breadcrumb;
    use html\components\Footer;
    use html\components\Head;
    use html\components\PageSelector;
    use html\components\PrincipalMenu;
    use html\components\ProfileReviews;
    use html\components\ProfiloMenu;
    use html\components\ResponseMessage;
    use html\Template;
    use model\BreadcrumbItem;
    use model\Paginator;

    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');
    RouteController::loggedRoute();

 
    $userController= new UserController();
    $reviews = $userController->getReviewUtente();

    $_page= new Template('profilo');

    $page = isset($page) ? $page : 1;

    $paginatedReview = Paginator::paginate($reviews, $page);

    
    $_page->replaceTag('HEAD', (new Head));

    
    $_page->replaceTag('NAV-MENU', (new PrincipalMenu));

    // Set breadcrumb
    $breadcrumb=array(
        new BreadcrumbItem("./datipersonali.php","Profilo"),
        new BreadcrumbItem("#","Recensioni effettuate")
    );

    $_page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));



    $_page->replaceTag('PROFILOMENU', (new ProfiloMenu));

    $_page->replaceTag('ORDINI-PROFILO', '');
    $_page->replaceTag('DATIPERSONALI', '');

    if (empty($reviews)) {
        $_page->replaceTag('RECENSIONI-PROFILO', new ResponseMessage("Non hai nessuna recensione per ora..."));
        $_page->replaceTag('PAGE_SELECTOR', '');
    }
    else {
        $_page->replaceTag('RECENSIONI-PROFILO', (new ProfileReviews($reviews)));
        $paginatedReview = Paginator::paginate($reviews , $page);
        $_page->replaceTag('PAGE_SELECTOR', (new PageSelector($paginatedReview)));
    }
    
    $_page->replaceTag('FOOTER', (new Footer));

    echo $_page;