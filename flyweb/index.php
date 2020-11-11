<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // TODO: This is for debug only
    if ($_SESSION['logged_in']) {
        echo '<p>You\'re logged in!!</p>';
        echo '<p><a href="./logout.php">Log out</a></p>';
    } else {
        echo 'You\'re not logged in';
        echo '<p><a href="./login.php">Log in</a></p>';
    }


    $page = new \html\template('index');

    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));

    // Set search box form
    $page->replaceTag('SEARCH_BOX', (new \html\components\searchBox));

    echo $page;