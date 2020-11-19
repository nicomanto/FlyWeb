<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // TODO: This is for debug only
    if ($_SESSION['logged_in']) {
        echo '<p>You\'re logged in!!</p>';
        $user = "LoggedUser";
    } else {
        echo 'You\'re not logged in';
        $user = "NotLoggedUser";
    }


    $page = new \html\template('index');

    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));

    // Set nav menu
    $page->replaceTag('NAV-MENU', (new \html\components\NavMenu));

    $page->replaceTag('SUGGESTIONS', (new \html\components\boxSuggerimenti));

    // Set search box form
    $page->replaceTag('SEARCH_BOX', (new \html\components\searchBox));

    // Set footer
    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;