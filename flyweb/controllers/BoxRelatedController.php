<?php

namespace controllers;

class BoxRelatedController extends BaseController {

    private $id_tag;
    private $id_viaggio;
    private $num_sugg;
    private $related;
    private $img;

    public function __construct($id_tag,$id_viaggio,$img=null,$num_sugg=4) {
        parent::__construct();
        $this->id_tag=$id_tag;
        $this->id_viaggio=$id_viaggio;
        $this->num_sugg=$num_sugg;
        $this->img=$img;
        $this->related=$this->get_RandomElements();
    }

    public function get_RandomElements() {
        $query = "SELECT ID_Viaggio, Titolo, DescrizioneBreve, Immagine, AltImmagine FROM Viaggio WHERE DataFine <= CURDATE() AND ID_Viaggio IN (SELECT ID_Viaggio FROM TagViaggio WHERE ID_Tag=? OR ID_Tag=? OR ID_Tag=? OR ID_Tag=?) AND ID_Viaggio!=? ORDER BY RAND() LIMIT ?";

        $rand_keys=array();
        for($i=0;$i<4;$i++){
            array_push($rand_keys,array_rand($this->id_tag));
        }
        
        return $this->db->runQuery($query,$this->id_tag[$rand_keys[0]],$this->id_tag[$rand_keys[1]],$this->id_tag[$rand_keys[2]],$this->id_tag[$rand_keys[3]],$this->id_viaggio,$this->num_sugg);
    }

    public function get_related(){
        return $this->related;
    }

}