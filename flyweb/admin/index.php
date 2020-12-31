<?php
    use controllers\RouteController;
    use controllers\UserController;
    use model\User;
    use html\components\AdmInfoHome;
    use html\components\AdmFooter;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    // This route can be accessed only by admins
    RouteController::protectedRoute();

    


    $page = new \html\template('board');


    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard));

    $breadcrumb=array(
        new model\BreadcrumbItem("/admin/index.php","Pannello di amministrazione")
    );

    $page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    $page->replaceTag('ADM-CONTENUTO', new \html\components\AdmInfoHome());

    $page->replaceTag('ADM-FOOTER', new AdmFooter());

    echo $page;