<?php

namespace controllers;

class FormInserimentoViaggio extends BaseController {

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

    //return list of all Tags
    public function getTags() {
        $query = "SELECT * FROM Tag ";  
        return ! empty($this->db->runQuery($query));
    }

    //insert a row in 'Viaggio', citta and localita by def is null bc citta and localita are optional fields in the form (and in the db they can be null)
    public function insertViaggio($titolo, $data_inizio, $data_fine, $prezzo, $descrizione, $descrizione_breve, $stato, $citta=null, $localita=null){
        $query='INSERT INTO Viaggio( ?, ?, ?, ?, ?, ?, ?, ?, ?)
                VALUES (Viaggio(?, ?, ?, ?, ?, ?, ?, ?, ?);';

        return ! empty($this->db->runQuery( $titolo, $data_inizio, $data_fine, $prezzo, $descrizione, $descrizione_breve, $stato, $citta=null, $localita=null,
                                            $titolo, $data_inizio, $data_fine, $prezzo, $descrizione, $descrizione_breve, $stato, $citta=null, $localita=null));
    }
}
