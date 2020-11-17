<?php

namespace controllers;
use model\Travel;

class IntegrazioneController extends BaseController {

    public function __construct() {
        parent::__construct();
    }


    public function getIntegrazioni($idViaggio) {
        $query ='   SELECT I.ID_Integrazione, I.Nome, I.Prezzo
                    FROM    Integrazione as I, ViaggioIntegrazione as VI
                    WHERE   I.ID_Integrazione = VI.ID_Integrazione AND
                            VI.ID_Viaggio = ?;
                ';
        return ($this->db->runQuery($query, $idViaggio));
    }

    public function setInegrazione($integrazione, $idViaggio){
        //to-do
    }

}
