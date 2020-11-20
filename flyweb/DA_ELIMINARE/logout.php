<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    // Unset session
    session_unset();

    // Unset cookie
    setcookie('flw_user', '', time() - 3600);
    setcookie('flw_password', '', time() - 3600);

    // Redirect to home page
    header('location:index.php');
    exit();