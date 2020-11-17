<?php

namespace controllers;

use model\Travel;

class TravelController extends BaseController {

    public $travel;

    public function __construct(int $travelId) {
        parent::__construct();
        $this->getTravelDetail($travelId);
    }

    public function getTravelDetail(int $travelId) {

        $query = 'SELECT * FROM Viaggio WHERE ID_Viaggio = ?;';
        print_r($this->db->runQuery($query, $travelId)[0]);
        $this->travel = new Travel($this->db->runQuery($query, $travelId)[0]);
    }   

    public function deleteTravel(int $id) {
        $query = 'DELETE FROM Viaggio WHERE ID_Viaggio = ?;';
        ($this->db->runQuery($query, $id)[0]);
    }

    public function getTravelReviewsList() {
        $query = 'SELECT Recensione.* FROM Recensione,RecensioneViaggio WHERE RecensioneViaggio.ID_Viaggio = ? AND Recensione.ID_Recensione= RecensioneViaggio.ID_Recensione;';
        return $this->db->runQuery($query, $this->travel->id_viaggio);
    }

    public function haveReviews(){
        $query = 'SELECT Recensione.* FROM Recensione,RecensioneViaggio WHERE RecensioneViaggio.ID_Viaggio = ? AND Recensione.ID_Recensione= RecensioneViaggio.ID_Recensione;';
        return ! empty($this->db->runQuery($query, $this->travel->id_viaggio));
    }
    public function getTitle(int $id) {
        $query = 'SELECT Titolo FROM Viaggio WHERE ID_Viaggio = ?;';
        $s = ($this->db->runQuery($query, $id));
        //echo $s[0]['Titolo'];
        return($s[0]['Titolo']);
    }

}