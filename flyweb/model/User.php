<?php

namespace model;

/**
 * Class that maps table `Utente` from Database
 */
class User {
    public $id_utente;
    public $username;
    public $password;
    public $nome;
    public $cognome;
    public $email;
    public $data_nascita;
    public $data_registrazione;
    public $admin;
    public $evil_bit;
    public $id_carrello;
    public $id_preferiti;

    /**
     * Workaround to have multiple constructors
     */
    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct'.$numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

        /**
     * Maps values from array (used to convert db associative arrays into User objects)
     */
    public function __construct1(array $user) {

        $timestamp = strtotime($user['DataNascita']);
        $data_nascita = date("d/m/Y", $timestamp);

        $timestamp = strtotime($user['DataRegistrazione']);
        $data_registrazione = date("d/m/Y", $timestamp);

        $this->id_utente = $user['ID_Utente'];
        $this->username = $user['Username'];
        $this->password = $user['Password'];
        $this->nome = $user['Nome'];
        $this->cognome = $user['Cognome'];
        $this->email = $user['Email'];
        $this->data_nascita = $data_nascita;
        $this->data_registrazione = $data_registrazione;
        $this->admin = $user['Admin'];
        $this->evil_bit = $user['EvilBit'];
        $this->id_carrello = $user['ID_Carrello'];
        $this->id_preferiti = $user['ID_Preferiti'];
    }

    /**
     * Constructor with all database's informations
     *
     * @param integer $id_utente
     * @param string $username
     * @param string $password
     * @param string $nome
     * @param string $cognome
     * @param string $email
     * @param string $data_nascita
     * @param string $data_registrazione
     * @param boolean $admin
     * @param boolean $evil_bit
     * @param integer $id_carrello
     * @param integer $id_preferiti
     */
    public function __construct12(int $id_utente, string $username, string $password, string $nome, string $cognome, string $email, string $data_nascita, string $data_registrazione,  bool $admin, bool $evil_bit, int $id_carrello, int $id_preferiti) {
        $this->id_utente = $id_utente;
        $this->username = $username;
        $this->password = $password;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->email = $email;
        $this->data_nascita = $data_nascita;
        $this->data_registrazione = $data_registrazione;
        $this->admin = $admin;
        $this->evil_bit = $evil_bit;
        $this->id_carrello = $id_carrello;
        $this->id_preferiti = $id_preferiti;
    }




     /**
      * Constructor with minimal informations to create a new user
      *
      * @param string $username
      * @param string $password
      * @param string $nome
      * @param string $cognome
      * @param string $email
      * @param string $data_nascita
      */
    public function __construct6(string $username, string $email, string $password, string $nome, string $cognome, string $data_nascita) {

        $this->id_utente = null;
        $this->username = $username;
        $this->password = $password;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->email = $email;
        $this->data_nascita = $data_nascita;
        $this->data_registrazione = null;
        $this->admin = null;
        $this->evil_bit = null;
        $this->id_carrello = null;
        $this->id_preferiti = null;
    }
}