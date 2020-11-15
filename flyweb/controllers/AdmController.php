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
        $query = "SELECT * FROM Tag;";  
        return ($this->db->runQuery($query));
    }

    //inserisce un viaggio
    public function inserisciViaggio($viaggio): void{
        $query='INSERT INTO Viaggio (Titolo, Descrizione, DescrizioneBreve, DataInizio, DataFine, Stato, Citta, Localita, Prezzo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);';
        
        //print_r($viaggio);

        $this->db->runQuery($query, 
                            $viaggio['titolo'], 
                            $viaggio['descrizione'], 
                            $viaggio['descrizionebreve'], 
                            $viaggio['datainizio'], 
                            $viaggio['datafine'], 
                            $viaggio['stato'], 
                            $viaggio['citta'], 
                            $viaggio['localita'], 
                            $viaggio['prezzo']);
    }

    //aggiorna un viaggio già esistente
    public function aggiornaViaggio($viaggio){
        $old_titolo = $viaggio['titolo'];
        $query='UPDATE Viaggio
                SET
                Titolo = ?,
                Descrizione = ?,
                DescrizioneBreve = ?,
                DataInizio = ?,
                DataFine = ?,
                Stato = ?,
                Citta = ?,
                Localita = ?,
                Prezzo = ?
                WHERE ID_VIAGGIO=?';
        $this->db->runQuery($query,
                            $viaggio['titolo'], 
                            $viaggio['descrizione'], 
                            $viaggio['descrizionebreve'], 
                            $viaggio['datainizio'], 
                            $viaggio['datafine'], 
                            $viaggio['stato'], 
                            $viaggio['citta'], 
                            $viaggio['localita'], 
                            $viaggio['prezzo'],
                            $viaggio['id']);
    }

    public function checkTravel(int $id):bool{
        $query = 'SELECT * FROM Viaggio WHERE ID_Viaggio = ?;';
        $ris = ($this->db->runQuery($query, $title)[0]);

        print_r($ris);
        return (empty($ris)?false:true);
    }
}
