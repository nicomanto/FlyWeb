<?php

namespace controllers;
use model\Integrazione;

class IntegrazioneController extends BaseController {

    public $integrazione;

    public function __construct(int $integrazioneID=null) {
        parent::__construct();
        if($integrazioneID){
            $this->getIntegrazione($integrazioneID);
        }
    }

    public function getIntegrazione(int $integrazioneID) {

        $query = 'SELECT * FROM Integrazione WHERE ID_Integrazione = ?;';
        print_r($this->db->runQuery($query, $integrazioneID)[0]);
        $this->integrazione = new Integrazione($this->db->runQuery($query, $integrazioneID)[0]);
    } 

    public function getIntegrazioneIdByNome($nome){
        $query = 'SELECT ID_Integrazione FROM Integrazione WHERE Nome=?';
        $r =$this->db->runQuery($query, $nome)[0];
        return $r['ID_Integrazione'];
    }

    public function inserisciIntegrazione($integrazione): void{
        $query='INSERT INTO Integrazione (Nome, Descrizione, Durata, Prezzo) VALUES (?, ?, ?, ?);';
        
        //print_r($integrazione);

        $this->db->runQuery($query, 
                            $integrazione['nome'], 
                            $integrazione['descrizione'], 
                            $integrazione['durata'], 
                            $integrazione['prezzo']);
    }

    public function deleteIntegrazione() {
        $query = 'DELETE FROM Integrazione WHERE ID_Integrazione = ?;';
        ($this->db->runQuery($query, $this->integrazione->id_integrazione)[0]);
    }

    public function aggiornaIntegrazione($integrazione){
        $query='UPDATE Integrazione
                SET
                Nome = ?,
                Descrizione = ?,
                Durata = ?,
                Prezzo = ?
                WHERE ID_Integrazione=?';
        $this->db->runQuery($query,
                            $viaggio['nome'], 
                            $viaggio['descrizione'], 
                            $viaggio['durata'], 
                            $viaggio['prezzo'],
                            $viaggio['id']);
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
