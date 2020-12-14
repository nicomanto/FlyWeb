<?php

    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::loggedRoute();

    // Unset session
    session_unset();

    // Redirect to home page
    header('location:/index.php');
    exit();