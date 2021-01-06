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
    public function __construct(array $integrazione)
    {
        $this->id_integrazione = $integrazione['ID_Integrazione'];
        $this->nome = $integrazione['Nome'];
        $this->descrizione = $integrazione['Descrizione'];
        $this->durata = $integrazione['Durata'];
        $this->prezzo = $integrazione['Prezzo'];

    }

}