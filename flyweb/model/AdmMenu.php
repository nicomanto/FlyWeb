<?php
    namespace model;

    class AdmMenu extends Menu{
        
        function __construct() {
            $this->MenuItem= array (
                "home" => new MenuItem("./index.php","Home",array("LoggedAdmin"),"en"),
                "inserisci_viaggio" => new MenuItem("./form_inserimento.php","Inserisci viaggio",array("LoggedAdmin")),
                "gestisci_viaggi"   => new MenuItem("./search.php","Gestisci viaggi",array("LoggedAdmin")),
                "inserisci_integrazione" => new MenuItem("./integrazione_inserimento.php","Inserisci integrazione",array("LoggedAdmin")),
                "gestisci_integrazioni" => new MenuItem("./integrazioni.php","Gestisci integrazioni",array("LoggedAdmin")),
                "modera_recensioni" => new MenuItem("./moderazione_recensioni.php","Modera recensioni",array("LoggedAdmin")),
                "logout" => new MenuItem("../logout.php","Logout",array("LoggedAdmin"))
            );    
        }

    }