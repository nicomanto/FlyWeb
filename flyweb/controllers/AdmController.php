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
                            $viaggio['descrizioneBreve'], 
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
                            $viaggio['descrizioneBreve'], 
                            $viaggio['datainizio'], 
                            $viaggio['datafine'], 
                            $viaggio['stato'], 
                            $viaggio['citta'], 
                            $viaggio['localita'], 
                            $viaggio['prezzo'],
                            $viaggio['id']);
    }

    public function checkTravel(int $idViaggio):bool{
        $query = 'SELECT * FROM Viaggio WHERE ID_Viaggio = ?;';
        $ris = ($this->db->runQuery($query, $idViaggio)[0]);

        //print_r($ris);
        return (empty($ris)?false:true);
    }


    //crea relazione tag-viaggio (relazione n-n scomposta in 1-n-n-1)
    public function setTagViaggio($id_viaggio, $tag){
        //echo "TAGS".$tags;
        $listatag = explode(";", $tag);
        //print_r($listatag);

        foreach($listatag as $v) {
            $query_id = 'SELECT ID_Tag FROM Tag WHERE Nome=? LIMIT 1;';
            $id_tag = $this->db->runQuery($query_id, $v)[0];

            echo "(".$id_tag['ID_Tag'].",".$id_viaggio.")";

            $query_tag= 'INSERT INTO TagViaggio(ID_Tag,ID_Viaggio) VALUES(?,?);';
            $this->db->runQuery($query_tag, (int)$id_tag['ID_Tag'], (int)$id_viaggio)[0];
        }
    }

    public function getTravelIdByTitle($titolo){
        $query = 'SELECT ID_Viaggio FROM Viaggio WHERE Titolo=?';
        $r =$this->db->runQuery($query, $titolo)[0];
        return $r['ID_Viaggio'];
    }

    public function resetTagViaggio($id){
        $query = 'DELETE FROM TagViaggio WHERE ID_Viaggio = ?;';
        $this->db->runQuery($query, $id)[0];
    }

    public function getUnapprovedReviewsList() {
        $query = 'SELECT R.* FROM Recensione as R WHERE R.Mod=0;';
        return $this->db->runQuery($query);
    }

    public function haveUnapprovedReviews(){
        $query = 'SELECT * FROM Recensione as R WHERE R.Mod=0;';
        return ! empty($this->db->runQuery($query));
    }

    public function approveReview($id){
        $query = 'UPDATE Recensione as R SET R.Mod=1 WHERE R.ID_Recensione=?;';
        $this->db->runQuery($query,$id);
    }

}