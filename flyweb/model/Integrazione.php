<?php

namespace model;

class Integrazione {
    public $id_integrazione;
    public $nome;
    public $descrizione;
    public $durata;
    public $prezzo;

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


    public function __construct1(array $integrazione) {
        $this->id_integrazione = $review['ID_Integrazione'];
        $this->nome = $review['Nome'];
        $this->descrizione = $review['Descrizione'];
        $this->durata = $review['Durata'];
        $this->prezzo = $review['Prezzo'];

    }

}