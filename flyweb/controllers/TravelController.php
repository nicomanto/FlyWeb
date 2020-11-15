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
        $this->travel = new Travel($this->db->runQuery($query, $travelId)[0]);
    }

    public function deleteTravel(int $id) {
        $query = 'DELETE FROM Viaggio WHERE ID_Viaggio = ?;';
        ($this->db->runQuery($query, $id)[0]);
    }

    public function getTitle(int $id) {
        $query = 'SELECT Titolo FROM Viaggio WHERE ID_Viaggio = ?;';
        $s = ($this->db->runQuery($query, $id));
        //echo $s[0]['Titolo'];
        return($s[0]['Titolo']);
    }

}