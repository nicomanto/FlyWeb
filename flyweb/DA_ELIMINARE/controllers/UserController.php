<?php

namespace controllers;

use model\User;

class UserController extends BaseController {

    public $user;

    public function __construct(int $id_user) {
        parent::__construct();
        $this->getTravelDetail($id_user);
    }

    private function getTravelDetail(int $id_user) {
        $query = 'SELECT * FROM Utente WHERE ID_Utente = ?;';
        $this->user = new User($this->db->runQuery($query, $id_user)[0]);
    }
}