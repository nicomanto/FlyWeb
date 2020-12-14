<?php

namespace controllers;

use model\User;

class SignupController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Adds a new user to database with given params 
     *
     * @param string $user
     * @param string $password
     * @return void
     */
    public function registerUser(string $username, string $email, string $password, string $name, string $surname, string $birth_date) {
        $user = new User($username, $email, $password, $name, $surname, $birth_date);

        $this->createUserInDB($user);
    }

    /**
     * Creates a user in db
     *
     * @return void
     */
    private function createUserInDB(User $user): void {
        // TODO: add birth date and registration_date
        $createUserQuery = 'INSERT INTO Utente (Username, Password, Nome, Cognome, Email, DataNascita) VALUES (?, ?, ?, ?, ?, ?);';
        
        $this->db->runQuery($createUserQuery,
            $user->username, 
            $user->password, 
            $user->nome,
            $user->cognome,
            $user->email,
            $user->data_nascita
        );
    }
}