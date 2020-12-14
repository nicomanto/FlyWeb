<?php

namespace controllers;

class BoxSuggerimentiController extends BaseController {

    private $number_sugg;
    private $type;
    private $suggerimenti;

    public function __construct($number_sugg,$type) {
        parent::__construct();
        $this->number_sugg=$number_sugg;
        $this->type=$type;
        $this->suggerimenti=$this->get_RandomElements();
    }

    public function get_RandomElements() {
        $query = "SELECT Nome, Immagine FROM ".$this->type." ORDER BY RAND() LIMIT ".$this->number_sugg;

        return $this->db->runQuery($query);
    }
    
    public function get_suggerimenti(){
        return $this->suggerimenti;
    }

}

