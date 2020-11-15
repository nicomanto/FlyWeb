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

    //inserisce nuovo viaggio nel db
    public function inserisciViaggio($dati): void{
        $query='INSERT INTO Viaggio (Titolo, Descrizione, DescrizioneBreve, DataInizio, DataFine, Stato, Citta, Localita, Prezzo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);';
        
        $this->db->runQuery($query, 
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
