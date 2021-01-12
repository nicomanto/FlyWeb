<?php
    namespace model;

    class AdmMenu extends Menu{
        
        function __construct() {
            $this->MenuItem= array (
                "home" => new MenuItem("/admin/index.php","Home",array("LoggedAdmin"),"en"),
                "inserisci_viaggio" => new MenuItem("/admin/form_inserimento.php","Inserisci viaggio",array("LoggedAdmin")),
                "gestisci_viaggi"   => new MenuItem("/admin/search.php","Gestisci viaggi",array("LoggedAdmin")),
                "modera_recensioni" => new MenuItem("/admin/moderazione_recensioni.php","Modera recensioni",array("LoggedAdmin")),
                "logout" => new MenuItem("/logout.php","Logout",array("LoggedAdmin"))
            );    
        }

    }