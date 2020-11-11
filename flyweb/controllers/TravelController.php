<?php

namespace controllers;

use model\Travel;

class TravelController extends BaseController {

    public $travel;

    public function __construct(int $travelId) {
        parent::__construct();
        $this->getTravelDetail($travelId);
    }

    private function getTravelDetail(int $travelId) {
        $query = 'SELECT * FROM Viaggio WHERE ID_Viaggio = ?;';
        $this->travel = new Travel($this->db->runQuery($query, $travelId)[0]);
    }
}