<?php

namespace model;

class Travel {
    public $id_viaggio;
    public $nome;
    public $data_inizio;
    public $data_fine;
    public $prezzo;
    public $descrizione;

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
     * Constructor with all database's informations
     *
     * @param integer $id_viaggio
     * @param string $nome
     * @param string $data_inizio
     * @param string $data_fine
     * @param integer $prezzo
     * @param string $descrizione
     * @return void
     */
    public function __construct6(int $id_viaggio, string $nome, string $data_inizio, string $data_fine, int $prezzo, string $descrizione) {
        $this->id_viaggio = $id_viaggio;
        $this->nome = $nome;
        $this->data_inizio = $data_inizio;
        $this->data_fine = $data_fine;
        $this->prezzo = $prezzo;
        $this->descrizione = $descrizione;
    }

    /**
     * Constructor with minimal informations to create a new travel
     *
     * @param string $nome
     * @param string $data_inizio
     * @param string $data_fine
     * @param integer $prezzo
     * @param string $descrizione
     * @return void
     */
    public function __construct5(string $nome, string $data_inizio, string $data_fine, int $prezzo, string $descrizione) {
        $this->nome = $nome;
        $this->data_inizio = $data_inizio;
        $this->data_fine = $data_fine;
        $this->prezzo = $prezzo;
        $this->descrizione = $descrizione;
    }
}