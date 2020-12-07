<?php
    namespace model;

    class AdmMenu extends Menu{
        
        function __construct() {
            $this->MenuItem= array (

                "inserisci_viaggio" => new MenuItem("adm_form_inserimento.php","Iserisci viaggio",array("LoggedAdmin")),
                "gestisci_viaggi"   => new MenuItem("adm_search.php","Gestisci viaggi",array("LoggedAdmin")),
                "inserisci_integrazione" => new MenuItem("adm_integrazione_inserimento.php","Inserisci integrazione",array("LoggedAdmin")),
                "gestisci_integrazioni" => new MenuItem("adm_integrazioni.php","Gestisci integrazioni",array("LoggedAdmin")),
                "modera_recensioni" => new MenuItem("adm_moderazione_recensioni.php","Modera recensioni",array("LoggedAdmin")),
                "logout" => new MenuItem("index.php","Logout",array("LoggedAdmin"))
            );    
        }

    }