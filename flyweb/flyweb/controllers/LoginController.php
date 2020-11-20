<?php

namespace controllers;

class LoginController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Check if given `$user` and `$password` are valid credentials
     *
     * @param [type] $user
     * @param [type] $password
     * @return void
     */
    public function checkUserAuth($user, $password) {
        $query = 'SELECT * FROM Utente WHERE (Username = ? OR Email = ?) AND Password = ?;';
        return ! empty($this->db->runQuery($query, $user, $user, $password));
    }

}
