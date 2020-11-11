<?php
    namespace model;

    class Menu{

        private $MenuItem;
        
        function __construct() {
            $this->MenuItem= array (
                "home"  => new MenuItem("Home.php","Home",array("NotLog", "LogAmministratore","LogUser")),
                "aboutUs" => new MenuItem("AboutUs.php","About us",array("NotLog", "LogAmministratore","LogUser")),
                "profilo"   => new MenuItem("Profilo.php","Profilo",array("LogAmministratore","LogUser")),
                "carrello" => new MenuItem("Carrello.php","Carrello",array("LogUser")),
                "login" => new MenuItem("Login.php","Login",array("NotLog")),
                "logOut" => new MenuItem("LogOut.php","Log out",array("LogAmministratore","LogUser")),
                "signIn" => new MenuItem("SignIn.php","Sign in",array("NotLog"))
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