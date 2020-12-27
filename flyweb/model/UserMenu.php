<?php
    namespace model;

    class UserMenu extends Menu{
        
        function __construct() {
            $this->MenuItem= array (
                "home"  => new MenuItem("/index.php","Home",array("NotLoggedUser", "LoggedAdmin","LoggedUser"),"en"),
                "aboutUs" => new MenuItem("/aboutUs.php","About us",array("NotLoggedUser", "LoggedAdmin","LoggedUser"),"en"),
                "profilo"   => new MenuItem("/datipersonali.php","Profilo",array("LoggedAdmin","LoggedUser")),
                "carrello" => new MenuItem("/carrello.php","Carrello",array("LoggedUser")),
                "login" => new MenuItem("/login.php","Accedi",array("NotLoggedUser")),
                "logOut" => new MenuItem("/logout.php","Esci",array("LoggedAdmin","LoggedUser")),
                "signUp" => new MenuItem("/signup.php","Registrati",array("NotLoggedUser"))
            );    
        }
    }