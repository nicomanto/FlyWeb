<?php
    namespace model;

    class AdmMenu extends Menu{
        
        function __construct() {
            $this->MenuItem= array (

                //TO-DO rimuovere 'NotLoggedUser' da ogni array, è solo per visualizzare la componente senza essere admin
                "inserisci_viaggio" => new MenuItem("adm_form_inserimento.php","Iserisci viaggio",array("NotLoggedUser","LogAmministratore")),
                "gestisci_viaggi"   => new MenuItem("adm_search.php","Gestisci viaggi",array("NotLoggedUser","LogAmministratore")),
                "inserisci_integrazione" => new MenuItem("adm_integrazione_inserimento.php","Inserisci integrazione",array("NotLoggedUser","LogAmministratore")),
                "gestisci_integrazioni" => new MenuItem("adm_integrazioni.php","Gestisci integrazioni",array("NotLoggedUser","LogAmministratore")),
                "modera_recensioni" => new MenuItem("adm_moderazione_recensioni.php","Modera recensioni",array("NotLoggedUser","LogAmministratore")),
                "logout" => new MenuItem("index.php","Logout",array("NotLoggedUser","LogAmministratore"))
            );    
        }

    }