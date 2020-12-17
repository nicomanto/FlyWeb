<?php

namespace controllers;

use model\User;

class UserController extends BaseController {

    public $user;

    public function __construct($id_user=-1) {
        if ($id_user == -1) {
            $id_user = $_SESSION['ID_Utente'];
        }
        parent::__construct();
        $this->getUserDetail($id_user);
    }

    public function getUserDetail($id_user) {
        $query = 'SELECT * FROM Utente WHERE ID_Utente = ?;';
        $this->user = new User($this->db->runQuery($query, $id_user)[0]);
    }

    //query che ritorna gli ordini effettuati da un utente dato il suo ID

    public function getOrderList() {
        $query = 'SELECT * FROM Ordine WHERE ID_Utente = ?;';
        return $this->db->runQuery($query, $this->user->id_utente);
    }

    //query che elimina un utente 

    public function deleteUser() {
        $query = 'DELETE FROM Utente WHERE ID_Utente = ?;';
        return $this->db->runQuery($query, $this->user->id_utente);
    }

    //query che ritorna le recensioni lasciate dagli utenti

    public function getReviewUtente(){
        $query = 'SELECT * FROM Recensione WHERE ID_Utente = ?;';
        return $this->db->runQuery($query, $this->user->id_utente);
    }

    //query che aggiorna i dati nel db di un utente

    public function aggiornaUtente(){
            $query='UPDATE Utente SET  Password = ?, Nome = ?, Cognome = ?, Email = ?, DataNascita = ? WHERE ID_Utente=?';
             $this->db->runQuery($query,
                                $this->user->password, 
                                $this->user->nome, 
                                $this->user->cognome, 
                                $this->user->email,
                                $this->user->data_nascita,
                                $this->user->id_utente);
    }

}