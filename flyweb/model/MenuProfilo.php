<?php
    namespace model;

    class MenuProfilo{

        private $MenuItem;
        
        function __construct() {
            $this->MenuItem= array (
                "dati"  => new MenuItem("datiPersonali.php","Dati Personali",array("LoggedUser")),
                "ordini" => new MenuItem("ordiniProfilo.php","Ordini",array("LoggedUser")),
                "recensioni" => new MenuItem("recensioniProfilo.php","Recensioni",array("LoggedUser"))
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