<?php
    namespace model;

    class UserMenu extends Menu{
        
        function __construct() {
            $this->MenuItem= array (
                "home"  => new MenuItem("index.php","Home",array("NotLoggedUser", "LogAmministratore","LoggedUser"),"en"),
                "aboutUs" => new MenuItem("aboutUs.php","About us",array("NotLoggedUser", "LogAmministratore","LoggedUser"),"en"),
                "profilo"   => new MenuItem("profilo.php","Profilo",array("LogAmministratore","LoggedUser")),
                "carrello" => new MenuItem("carrello.php","Carrello",array("LoggedUser")),
                "login" => new MenuItem("login.php","Accedi",array("NotLoggedUser")),
                "logOut" => new MenuItem("logout.php","Esci",array("LogAmministratore","LoggedUser")),
                "signUp" => new MenuItem("signup.php","Registrati",array("NotLoggedUser"))
            );    
        }
    }