<?php

namespace controllers;

class RouteController {


    public const BASE_ROUTE = '/fipinton';
    public const ADMIN_BASE_ROUTE = self::BASE_ROUTE . '/admin';


    public static function protectedRoute(): void {
        if (!$_SESSION['admin'] || !$_SESSION['logged_in']) {
            header('location:' . self::BASE_ROUTE . '/index.php');
            exit();
        }
    }

    public static function unprotectedRoute(): void {
        if ($_SESSION['admin']) {
            header('location:' . self::ADMIN_BASE_ROUTE . '/index.php');
            exit();
        }
    }

    public static function unloggedRoute(): void {
        if ($_SESSION['logged_in'] && $_SESSION['admin']) {
            header('location:' . self::ADMIN_BASE_ROUTE . '/index.php');
            exit();
        } else if ($_SESSION['logged_in']) {
            header('location:' . self::BASE_ROUTE . '/index.php');
            exit();
        }
    }

    public static function loggedRoute(): void {
        if (!$_SESSION['logged_in']) {
            header('location:' . self::BASE_ROUTE . '/index.php');
            exit();
        }
    }

}