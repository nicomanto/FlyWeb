<?php

namespace controllers;

use model\User;
use model\Travel;

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
        $query = 'DELETE  FROM Utente  WHERE ID_Utente = ?;';
        return $this->db->runQuery($query, $this->user->id_utente);
    }

    //query che ritorna le recensioni lasciate dagli utenti

    public function getReviewUtente(){
        $query = 'SELECT * FROM Recensione WHERE ID_Utente = ? ORDER BY Recensione.Data DESC;';
        return $this->db->runQuery($query, $this->user->id_utente);
    }

    public function getPassword(){
        $query = 'SELECT Password FROM Utente WHERE ID_Utente = ?;';
        return $this->db->runQuery($query, $this->user->id_utente)[0];
    }

    public function getNome(){
        $query = 'SELECT Nome FROM Utente WHERE ID_Utente = ?;';
        return $this->db->runQuery($query, $this->user->id_utente);
    }

    //query che aggiorna i dati nel db di un utente

    public function aggiornaUtente(){
            $query='UPDATE Utente SET Username = ?, Nome = ?, Cognome = ?, Email = ?, DataNascita = ? WHERE ID_Utente=?';
             $this->db->runQuery($query,
                                $this->user->username, 
                                $this->user->nome, 
                                $this->user->cognome, 
                                $this->user->email,
                                $this->user->data_nascita,
                                $this->user->id_utente);
    }

    public function aggiornaPsw(){
        $query='UPDATE Utente SET Password = ? WHERE ID_Utente=?';
        $this->db->runQuery($query, $this->user->password, $this->user->id_utente);
    }

    public function getViaggiCarrello(){
        $query='SELECT Viaggio.* FROM Viaggio, CarrelloViaggio, Carrello WHERE Carrello.ID_Utente =? AND Viaggio.ID_Viaggio = CarrelloViaggio.ID_Viaggio AND CarrelloViaggio.ID_Carrello = Carrello.ID_Carrello;';
        return($this->db->runQuery($query, $this->user->id_utente));
    }

    public function getIDViaggiCarrello(){
        $query='SELECT Viaggio.ID_Viaggio FROM Viaggio, CarrelloViaggio, Carrello WHERE Carrello.ID_Utente =? AND Viaggio.ID_Viaggio = CarrelloViaggio.ID_Viaggio AND CarrelloViaggio.ID_Carrello = Carrello.ID_Carrello;';
        return($this->db->runQuery($query, $this->user->id_utente));
    }

    public function deleteViaggioCarrello($id) {
        $query = 'DELETE FROM CarrelloViaggio WHERE ID_Viaggio = ?;';
        return $this->db->runQuery($query, $id);
    }

     public function getSubtotale(){
        $list_items_cart=$this->getViaggiCarrello();
        $subtotale=0;

        foreach($list_items_cart as $i){
            $viaggio= new Travel($i);
            $subtotale+=$viaggio->prezzo;
            
        }
        return $subtotale;

    }

    public function ordineTemporaneo($dati){
        $query= 'INSERT INTO OrdineTemporaneo(ID_Utente, Via, Cap, Provincia, Comune, MetodoPagamento, Totale) VALUES (?,?,?,?,?,?,?);';
        $this->db->runQuery($query, 
                            $this->user->id_utente, 
                            $dati['via'], 
                            $dati['cap'], 
                            $dati['provincia'], 
                            $dati['comune'], 
                            $dati['metodopagamento'], 
                            $dati['totale']);
    }

    public function estraiDatiOrdineTemporaneo(){
            $query='SELECT * FROM OrdineTemporaneo WHERE ID_Utente=?';
            return($this->db->runQuery($query, $this->user->id_utente)[0]);
    }


    public function addOrder($dati){
        $query= 'INSERT INTO Ordine(ID_Utente, Via, Cap, Provincia, Comune, MetodoPagamento, Totale) VALUES (?,?,?,?,?,?,?);';
        $this->db->runQuery($query, 
                            $this->user->id_utente, 
                            $dati['Via'], 
                            $dati['Cap'], 
                            $dati['Provincia'], 
                            $dati['Comune'], 
                            $dati['MetodoPagamento'], 
                            $dati['Totale']);
    }

    public function eliminaOrdineTemporaneo(){
        $query = 'DELETE  FROM OrdineTemporaneo  WHERE ID_Utente = ?;';
        return $this->db->runQuery($query, $this->user->id_utente);
    }

    public function eliminaCarrello(){
            $query = 'DELETE FROM Carrello WHERE ID_Utente = ?;';
            return $this->db->runQuery($query, $this->user->id_utente);
        
    }

    public function getID_Order(){
        $query='SELECT ID_Ordine FROM Ordine WHERE ID_Utente = ?  ORDER BY DataOrdine DESC LIMIT 1;';
        return $this->db->runQuery($query, $this->user->id_utente)[0];
    }

    public function addViaggiOrdine($id_ordine, $dati){
        foreach ($dati as $id) {
            $query= 'INSERT INTO OrdineViaggio(ID_Ordine, ID_Viaggio) VALUES (?,?);';
            $this->db->runQuery($query, 
                            $id_ordine["ID_Ordine"], $id["ID_Viaggio"]);
    }
        }

    
}