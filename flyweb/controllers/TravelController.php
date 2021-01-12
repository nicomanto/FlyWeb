<?php

namespace controllers;

use model\Travel;

use model\Review;

class TravelController extends BaseController {

    public $travel;

    public function __construct(int $travelId) {
        parent::__construct();
        $this->getTravelDetail($travelId);
    }

    public function getTravelDetail(int $travelId) {

        $query = 'SELECT * FROM Viaggio WHERE ID_Viaggio = ?;';
        //print_r($this->db->runQuery($query, $travelId)[0]);
        $this->travel = new Travel($this->db->runQuery($query, $travelId)[0]);
    }
    
    public function getTravelReviewsList() {
        $query = 'SELECT Recensione.* FROM Recensione,RecensioneViaggio WHERE RecensioneViaggio.ID_Viaggio = ? AND Recensione.ID_Recensione= RecensioneViaggio.ID_Recensione ORDER BY Recensione.Data DESC;';
        return $this->db->runQuery($query, $this->travel->id_viaggio);
    }

    public function haveReviews(){
        $query = 'SELECT Recensione.* FROM Recensione,RecensioneViaggio WHERE RecensioneViaggio.ID_Viaggio = ? AND Recensione.ID_Recensione= RecensioneViaggio.ID_Recensione;';
        return ! empty($this->db->runQuery($query, $this->travel->id_viaggio));
    }

    public function haveModReview(){
        $query = 'SELECT Recensione.* FROM Recensione,RecensioneViaggio WHERE RecensioneViaggio.ID_Viaggio = ? AND Recensione.ID_Recensione= RecensioneViaggio.ID_Recensione AND Recensione.Mod=1;';
        return ! empty($this->db->runQuery($query, $this->travel->id_viaggio));
    }

    public function deleteTravel() {
        $query = 'DELETE FROM Viaggio WHERE ID_Viaggio = ?;';
        ($this->db->runQuery($query, $this->travel->id_viaggio)[0]);
    }

    public function getTitle(int $id) {
        $query = 'SELECT Titolo FROM Viaggio WHERE ID_Viaggio = ?;';
        $s = ($this->db->runQuery($query, $id));
        //echo $s[0]['Titolo'];
        return($s[0]['Titolo']);
    }

    public function getAverageReviews(){
        $list_review=$this->getTravelReviewsList();
        $average_reviews=0;

        foreach($list_review as $i){
            $review= new Review($i);
            
            if($review->mod!=0) //controllo se la review è stata moderata
                $average_reviews+=$review->valutazione;
            
        }


        return round($average_reviews/$this->getNumberOfReviews(),1);

    }

    public function getNumberOfReviews(){

        $list_review=$this->getTravelReviewsList();
        $n_reviews=0;

        foreach($list_review as $i){
            $review= new Review($i);
            
            if($review->mod!=0) //controllo se la review è stata moderata
                $n_reviews++;
            
        }

        return $n_reviews;
    }


    public function getIdTag(){
        $query = 'SELECT ID_Tag FROM TagViaggio WHERE ID_Viaggio = ?;';

        $id_tag=array();
        foreach(($this->db->runQuery($query, $this->travel->id_viaggio)) as $element){
            array_push($id_tag,$element["ID_Tag"]);
        }

        return $id_tag;
    }

    public function haveRelatedTravel(){
        $query = 'SELECT ID_Viaggio FROM TagViaggio WHERE ID_Viaggio!= ? AND ID_Tag IN (SELECT ID_Tag FROM TagViaggio WHERE ID_Viaggio = ?);';

        
    }


    
    public function haveUserReview(int $id_user){
        $query = 'SELECT ID_Viaggio FROM RecensioneViaggio WHERE ID_Recensione IN (SELECT ID_Recensione FROM Recensione WHERE ID_Utente= ?) ;';
       
        if (! empty($this->db->runQuery($query, $id_user))){
            foreach($this->db->runQuery($query, $id_user) as $id_viaggio){
                if($id_viaggio['ID_Viaggio']==$this->travel->id_viaggio){
                   
                    return true;
                }
            }
        }

        return false;
    }
}