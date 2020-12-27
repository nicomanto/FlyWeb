<?php

namespace controllers;

require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');


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

        foreach($tag as $tagItem) {
            $query_id = 'INSERT INTO TagViaggio(ID_Tag,ID_Viaggio) VALUES(?,?);';
            $this->db->runQuery($query_id,$tagItem,$id_viaggio);
        }
    }

    //resetta le relazioni tra il viaggio che corrisponde a $id e tutte i tag a lui associati
    public function resetTagViaggio($id){
        $query = 'DELETE FROM TagViaggio WHERE ID_Viaggio = ?;';
        $this->db->runQuery($query, $id)[0];
    }

    //crea relazione integrazione-viaggio (relazione n-n scomposta in 1-n-n-1)
    public function setIntegrazioniViaggio($id_viaggio, $integrazioni){
        if(! empty($integrazioni)){
            foreach(($integrazioni) as $i) {
                $query_tag= 'INSERT INTO ViaggioIntegrazione(ID_Integrazione,ID_Viaggio) VALUES(?,?);';
                $this->db->runQuery($query_tag, (int)$i, (int)$id_viaggio);
            }
        }
    }

    //resetta le relazioni tra il viaggio che corrisponde a $id e tutte le integrazioni a lui associate
    public function resetIntegrazioneViaggio($id){
        $query = 'DELETE FROM ViaggioIntegrazione WHERE ID_Viaggio = ?;';
        $this->db->runQuery($query, $id)[0];
    }


    public function getTravelIdByTitle($titolo){
        $query = 'SELECT ID_Viaggio FROM Viaggio WHERE Titolo=?';
        $r =$this->db->runQuery($query, $titolo)[0];
        return $r['ID_Viaggio'];
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

    public function deleteReview($id){
        $query = 'DELETE FROM Recensione WHERE ID_Recensione=?;';
        $this->db->runQuery($query,$id);
    }
}
