<?php
    use controllers\RouteController;
    use html\components\BoxSuggerimenti;
    use html\components\Breadcrumb;
    use html\components\Footer;
    use html\components\Head;
    use html\components\PrincipalMenu;
    use html\components\SearchBox;
    use html\Template;
    use model\BreadcrumbItem;

    require_once('./autoload.php');

    RouteController::unprotectedRoute();

    // TODO: This is for debug only
    if ($_SESSION['logged_in']) {
        //echo '<p>You\'re logged in!!</p>';
        $user = "LoggedUser";
    } else {
        //echo 'You\'re not logged in';
        $user = "NotLoggedUser";
    }


    $page = new Template('index');

    

    // Set page head
    $page->replaceTag('HEAD', (new Head));

    // Set breadcrumb
    $breadcrumb=array(
        new BreadcrumbItem("#","Home","en")
    );

    // Set nav menu
    $page->replaceTag('NAV-MENU', (new PrincipalMenu));

    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    $page->replaceTag('SUGGESTIONS', (new BoxSuggerimenti));

    // Set search box form
    $page->replaceTag('SEARCH_BOX', (new SearchBox));

    // Set footer
    $page->replaceTag('FOOTER', (new Footer));

    echo $page;