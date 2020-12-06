<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Unset session
    session_unset();

    // Redirect to home page
    header('location:index.php');
    exit();