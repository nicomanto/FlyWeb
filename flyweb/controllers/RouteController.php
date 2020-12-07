<?php

namespace controllers;

class RouteController {

    public static function protectedRoute(): void {
        if (!$_SESSION['admin'] || !$_SESSION['logged_in']) {
            header('location:index.php');
            exit();
        }
    }

    public static function unprotectedRoute(): void {
        if ($_SESSION['admin']) {
            header('location:admin/index.php');
            exit();
        }
    }

    public static function unloggedRoute(): void {
        if ($_SESSION['logged_in'] && $_SESSION['admin']) {
            header('location:admin/index.php');
            exit();
        } else if ($_SESSION['logged_in']) {
            header('location:index.php');
            exit();
        }
    }

    public static function loggedRoute(): void {
        if (!$_SESSION['logged_in']) {
            header('location:index.php');
            exit();
        }
    }

}