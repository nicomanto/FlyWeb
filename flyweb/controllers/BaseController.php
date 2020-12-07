<?php

namespace controllers;

use model\Database;

require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

class BaseController {
    /**
     * @var Database riferimento a un oggetto che permette la connessione con il database del sito
     */
    public $db;

    /**
     * Constructor: configure a db connection
     */
    public function __construct() {
        // TODO: Manage onConnect errors
        $this->db = new Database();
        $this->db->connect();
    }

    /**
     * Checks if a user with `$user` email or username exists.
     * returns true if exists, false otherwise
     *
     * @param string $user
     * @return bool
     */
    public function checkUserExistence(string $user): bool {
        $emailExists = $this->checkEmailExistence($user);
        $usernameExist = $this->checkUsernameExistence($user);

        return $emailExists || $usernameExist;
    }

    /**
     * Returns true if a user with $email email already exists
     *
     * @param string $email
     * @return boolean
     */
    public function checkEmailExistence(string $email): bool {
        $query = 'SELECT * FROM Utente WHERE Email = ?;';
        return ! empty($this->db->runQuery($query, $email)); 
    }

    /**
     * Returns true if a user with $username username already exists
     *
     * @param string $username
     * @return boolean
     */
    public function checkUsernameExistence(string $username): bool {
        $query = 'SELECT * FROM Utente WHERE Username = ?;';
        return ! empty($this->db->runQuery($query, $username)); 
    }

    /**
     * Returns true if all $paramsName are given as post params.
     * If a param does not exists, returns it's name, otherwise returns ''
     *
     * @param array $post
     * @param array $paramsName
     * @return string
     */
    public function getMissingParams(array $post, array $paramsNames): string {
        foreach ($paramsNames as $param) {
            if (!array_key_exists($param, $post)) {
                return $param;
            }
        }

        return '';
    }
}
