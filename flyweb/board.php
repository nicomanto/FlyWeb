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


    $page = new \html\template('board');

    echo $page;

    // Set page head
    //$page->replaceTag('HEAD', (new \html\components\head));

        // Set nav menu
    $page->replaceTag('ADM-FORM-INSERIMENTO-VIAGGIO', (new \html\components\FormInserimentoViaggio));

    $page->replaceTag('NAV-MENU', (new \html\components\NavMenu));



    echo $page;