<?php
    use controllers\RouteController;
    use model\BreadcrumbItem;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::unprotectedRoute();

    // TODO: This is for debug only
    if ($_SESSION['logged_in']) {
        //echo '<p>You\'re logged in!!</p>';
        $user = "LoggedUser";
    } else {
        //echo 'You\'re not logged in';
        $user = "NotLoggedUser";
    }


    $page = new \html\template('index');

    

    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));

    // Set breadcrumb
    $breadcrumb=array(
        new model\BreadcrumbItem("#","Home","en")
    );

    $page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    // Set nav menu
    $page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    $page->replaceTag('SUGGESTIONS', (new \html\components\boxSuggerimenti));

    // Set search box form
    $page->replaceTag('SEARCH_BOX', (new \html\components\searchBox));

    // Set footer
    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;