<?php

    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::unprotectedRoute();

    // TODO: This is for debug only
    if ($_SESSION['logged_in']) {
        echo '<p>You\'re logged in!!</p>';
        $user = "LoggedUser";
    } else {
        echo 'You\'re not logged in';
        $user = "NotLoggedUser";
    }


    $page = new \html\template('aboutUs');

    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));

    // Set nav menu
    $page->replaceTag('NAV-MENU', (new \html\components\PrincipalMenu));

    // Set footer
    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;