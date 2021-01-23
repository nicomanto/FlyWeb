<?php

namespace controllers;

class RouteController {

    public static function protectedRoute(): void {
        if (!$_SESSION['admin'] || !$_SESSION['logged_in']) {
            header('location:./login.php');
            exit;
        }
    }

    public static function unprotectedRoute(): void {
        if ($_SESSION['admin']) {
            header('location:./adm_index.php');
        }
    }

    public static function unloggedRoute(): void {
        if ($_SESSION['logged_in'] && $_SESSION['admin']) {
            header('location:./adm_index.php');
            exit;
        } else if ($_SESSION['logged_in']) {
            header('location:./index.php');
            exit;
        }
    }

    public static function loggedRoute(): void {
        if (!$_SESSION['logged_in']) {
            
            // Store request for after-login redirect
            $_SESSION['redirect_uri'] = $_SERVER['REQUEST_URI'];
            
            // Eventually store post body 
            $_SESSION['redirect_body'] = $_POST;

            header('location:./login.php');
            exit;
        } else {
            // eventually load redirect uri 
            $GLOBALS['redirect_uri'] = $_SESSION['redirect_uri'];

            // Eventually load redirect body;
            $GLOBALS['redirect_body'] = $_SESSION['redirect_body'];   

            // unset redirect uri
            unset($_SESSION['redirect_uri']);
            // unset redirect body
            unset($_SESSION['redirect_body']);
        }
    }

}