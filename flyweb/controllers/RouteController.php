<?php

namespace controllers;

class RouteController {

    public static function protectRoute(): void {
        if (!$_SESSION['admin'] || !$_SESSION['logged_in']) {
            header('location:index.php');
            exit;
        }
    }

}