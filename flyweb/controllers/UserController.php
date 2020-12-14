<?php

namespace controllers;

use model\User;

class UserController extends BaseController {

    public $user;

    public function __construct($id_user) {
        parent::__construct();
        $this->getUserDetail($id_user);
    }

    public function getUserDetail($id_user) {
        $query = 'SELECT * FROM Utente WHERE ID_Utente = ?;';
        $this->user = new User($this->db->runQuery($query, $id_user)[0]);
    }

    //query che ritorna gli ordini effettuati da un utente dato il suo ID

    public function getOrderList($id_utente) {
        $query = 'SELECT * FROM Ordine WHERE ID_Utente = ?;';
        return $this->db->runQuery($query, $this->user->id_utente);
    }

    //query che elimina un utente 

    public function deleteUser( $id_user) {
        $query = 'DELETE FROM Utente WHERE ID_Utente = ?;';
        ($this->db->runQuery($query, $id_user)[0]);
    }

    //query che ritorna le recensioni lasciate dagli utenti

    public function getReviewUtente(int $id_user){
        $query = 'SELECT * FROM Recensione WHERE ID_Utente = ?;';
        return $this->db->runQuery($query, $this->user->id_utente);
    }

    //query che aggiorna i dati nel db di un utente

    public function aggiornaUtente($user){
            $query='UPDATE Utente SET  Password = ?, Nome = ?, Cognome = ?, Email = ?, DataNascita = ? WHERE ID_Utente=?';
             $this->db->runQuery($query,
                                $user['password'], 
                                $user['nome'], 
                                $user['cognome'], 
                                $user['email'],
                                $user['data_nascita'],
                                $user['id_utente']);
    }

    //query per recuperare ID tramite Username (uso per session)

    public function getIDFromUsername ($user){
        $query = ' SELECT ID_Utente, Password FROM Utente WHERE Username = ?';
        return $this->db->runQuery($query, $this->user->username)[0];

    }

}