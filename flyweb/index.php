<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    if ($_SESSION['logged_in']) {
        echo '<p>You\'re logged in!!</p>';
        echo '<p><a href="./logout.php">Log out</a></p>';
    } else {
        echo 'You\'re not logged in';
        echo '<p><a href="./login.php">Log in</a></p>';
    }
