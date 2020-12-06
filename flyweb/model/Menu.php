<?php
    namespace model;

    class Menu{

        private $MenuItem;
        
        function __construct() {
            $this->MenuItem= array (
                "home"  => new MenuItem("index.php","Home",array("NotLoggedUser", "LogAmministratore","LoggedUser")),
                "aboutUs" => new MenuItem("aboutUs.php","About us",array("NotLoggedUser", "LogAmministratore","LoggedUser")),
                "profilo"   => new MenuItem("profilo.php","Profilo",array("LogAmministratore","LoggedUser")),
                "carrello" => new MenuItem("carrello.php","Carrello",array("LoggedUser")),
                "login" => new MenuItem("login.php","Accedi",array("NotLoggedUser")),
                "logOut" => new MenuItem("logout.php","Esci",array("LogAmministratore","LoggedUser")),
                "signUp" => new MenuItem("signup.php","Registrati",array("NotLoggedUser"))
            );    
        }

        function build_menu(string $user){
            $final_menu=[];
            
            foreach ($this->MenuItem as $i) {
                foreach($i->get_accessibility() as $j){
                    if($user==$j){
                        array_push($final_menu,$i);
                        break;
                    }
                }
            }

            return $final_menu;
        }

    }

    ?>