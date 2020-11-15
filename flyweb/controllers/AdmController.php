<?php

namespace controllers;

require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');


class AdmController extends BaseController {

    public $travel_loc;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Check if given `$user` and `$password` are valid credentials
     *
     * @param [type] $user
     * @param [type] $password
     * @return void
     */

    //return list of all Tags
    public function getTags() {
        $query = "SELECT * FROM Tag ";  
        return ! empty($this->db->runQuery($query));
    }

    //insert a row in 'Viaggio', citta and localita by def is null bc citta and localita are optional fields in the form (and in the db they can be null)
    public function inserisciViaggio($dati): void{
        $query='INSERT INTO Viaggio (Titolo, Descrizione, DescrizioneBreve, DataInizio, DataFine, Stato, Citta, Localita, Prezzo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);';
        //$querytest ='INSERT INTO Viaggio (Titolo, Descrizione) VALUES (?, ?);';
   
        /*
        //Debug
        foreach ($dati as $key => $value) {
            echo "Key: $key; Value: $value\n";
        }
        */
        
        
        $flag = $this->db->runQuery($query, 
                            $dati['titolo'], 
                            $dati['descrizione'], 
                            $dati['descrizionebreve'], 
                            $dati['datainizio'], 
                            $dati['datafine'], 
                            $dati['stato'], 
                            $dati['citta'], 
                            $dati['localita'], 
                            $dati['prezzo']);
    }
}
