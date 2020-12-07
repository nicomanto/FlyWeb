<?php
    namespace model;

    class AdmMenu extends Menu{
        
        function __construct() {
            $this->MenuItem= array (

                "inserisci_viaggio" => new MenuItem("/admin/form_inserimento.php","Iserisci viaggio",array("LoggedAdmin")),
                "gestisci_viaggi"   => new MenuItem("/admin/search.php","Gestisci viaggi",array("LoggedAdmin")),
                "inserisci_integrazione" => new MenuItem("/admin/integrazione_inserimento.php","Inserisci integrazione",array("LoggedAdmin")),
                "gestisci_integrazioni" => new MenuItem("/admin/integrazioni.php","Gestisci integrazioni",array("LoggedAdmin")),
                "modera_recensioni" => new MenuItem("/admin/moderazione_recensioni.php","Modera recensioni",array("LoggedAdmin")),
                "logout" => new MenuItem("/logout.php","Logout",array("LoggedAdmin"))
            );    
        }

    }