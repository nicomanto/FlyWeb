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

    public function addToCart($idIntegrazione): bool{
        $user = $_COOKIE['flw_user'];

        if($this->check($idIntegrazione)){  //Se supera il controllo effettua la query e aggiungo integrazione al carrello
            $query_id_utente ='     SELECT U.ID_Utente 
                                    FROM Utente as U
                                    WHERE U.Username = ?
                                    LIMIT 1;';
            $query_id_carrello='    SELECT Carrello as C
                                    FROM Carello as C
                                    WHERE C.ID_Utente= ?
                                    LIMIT 1;';


            $idUser = $this->db->runQuery($query_id_utente, $user);
            $idCarr = $this->db->runQuery($query_id_carrello, $idUser['ID_Utente']);

            $query = 'INSERT INTO CarrelloIntegrazione(ID_Carrello,ID_Integrazione) VALUES (?,?)';
            $this->db->runQuery($query, $idCarr['ID_Carrello'], $idUser['ID_Utente']);
            return true;
        }else{                              
            return false;
        }
    }

    //controlla se nel carrello dell'utente $user è gia stata aggiunta l'integrazione $idIntegrazione
    public function check($idIntegrazione){
        $user = $_COOKIE['flw_user'];

        $query='SELECT * FROM Carrello as C, Utente as U, CarrelloIntegrazione as CI
                WHERE U.ID_Utente =(    SELECT U1.ID_Utente 
                                        FROM Utente as U1
                                        WHERE U1.Username = ?
                                    )
                AND C.ID_Utente = U.ID_Utente
                AND C.ID_Carrello = CI.ID_Carrello
                AND CI.ID_Integrazione = ?;';
        //restituisce true sse non c'è già nel carrello, altrimenti restittuicse false
        return empty($this->db->runQuery($query, $user, $idIntegrazione));
    }

}
