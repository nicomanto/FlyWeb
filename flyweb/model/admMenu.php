<?php
    namespace model;

    class AdmMenu{

        private $MenuItem;
        
        function __construct() {
            $this->MenuItem= array (
                "inserisciviaggio"  => new MenuItem(".php","Inserisci Viaggio",array("LogAmministratore")),
                "modificaviaggio"   => new MenuItem(".php","Modifica Viaggio ",array("LogAmministratore")),
                "moderarecensioni"  => new MenuItem(".php","Modera Recensioni",array("LogAmministratore")),
                "banutenti"         => new MenuItem(".php","Ban Utenti",array("LogAmministratore")),
                "aggiungitag"       => new MenuItem(".php","Aggiungi Tag",array("LogAmministratore")),
                "gestioneNewsletter"=> new MenuItem(".php","Gestione Newsletter",array("LogAmministratore"))
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