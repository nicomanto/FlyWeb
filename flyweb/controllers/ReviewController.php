<?php

namespace controllers;

use model\Review;

class ReviewController extends BaseController {


    public function __construct() {
        parent::__construct();
    }

    public function insertReview($review,$id_viaggio){

        //inserimento review
        $query = 'INSERT INTO Recensione (Titolo, Valutazione, Descrizione, ID_Utente, Data) VALUES (?,?,?,?,CURDATE());';
        $this->db->runQuery($query, $review->titolo, $review->valutazione,$review->descrizione, $review->id_utente);

        //inserimento reviewTravel
        $query = 'INSERT INTO RecensioneViaggio VALUES ((SELECT MAX(ID_Recensione) FROM Recensione),?);';
        $this->db->runQuery($query, $id_viaggio);
    }    
}