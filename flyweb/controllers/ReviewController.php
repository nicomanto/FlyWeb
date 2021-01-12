<?php

namespace controllers;

use model\Review;

class ReviewController extends BaseController {


    public function __construct() {
        parent::__construct();
    }

    public function insertReview($review,$id_viaggio){

        //inserimento review
        print($review->id_utente);
        $query = 'INSERT INTO Recensione (Titolo, Valutazione, Descrizione, ID_Utente, Data, Lingua) VALUES (?,?,?,?,CURDATE(),?);';
        $this->db->runQuery($query, $review->titolo, $review->valutazione,$review->descrizione, $review->id_utente,$review->lingua);

        //inserimento reviewTravel
        $query = 'INSERT INTO RecensioneViaggio VALUES ((SELECT MAX(ID_Recensione) FROM Recensione),?);';
        $this->db->runQuery($query, $id_viaggio);
    }
    
    public function getNumberNoModReview(){
        $query='SELECT COUNT(*) FROM Recensione WHERE `Mod`=0;';
        return $this->db->runQuery($query)[0]["COUNT(*)"];
    }

    public function getIdTravel(int $id_recensione){
        $query='SELECT ID_Viaggio FROM RecensioneViaggio WHERE ID_Recensione=?';
        return $this->db->runQuery($query,$id_recensione)[0]['ID_Viaggio'];
    }
}