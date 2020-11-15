<?php

namespace model;

class Travel {
    public $id_viaggio;
    public $titolo;
    public $data_inizio;
    public $data_fine;
    public $prezzo;
    public $descrizione;
    public $descrizionebreve;
    public $stato;
    public $citta;
    public $localita;

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
     * Maps values from array (used to convert db associative arrays into Travel objects)
     */
    public function __construct1(array $travel) {
        $this->id_viaggio = $travel['ID_Viaggio'];
        $this->titolo = $travel['Titolo'];
        $this->data_inizio = $travel['DataInizio'];
        $this->data_fine = $travel['DataFine'];
        $this->prezzo = $travel['Prezzo'];
        $this->descrizione = $travel['Descrizione'];
        $this->stato = $travel['Stato'];
        $this->citta = $travel['Citta'];
        $this->localita = $travel['Localita'];
    }

    /**
     * Constructor with minimal informations to create a new travel
     *
     * @param string $titolo
     * @param string $data_inizio
     * @param string $data_fine
     * @param integer $prezzo
     * @param string $descrizione
     * @return void
     */
    public function __construct5(string $titolo, string $data_inizio, string $data_fine, int $prezzo, string $descrizione, string $descrizionebreve,string $stato, string $citta, string $localita) {
        $this->titolo = $titolo;
        $this->data_inizio = $data_inizio;
        $this->data_fine = $data_fine;
        $this->prezzo = $prezzo;
        $this->descrizione = $descrizione;
        $this->descrizionebreve = $descrizionebreve;
        $this->stato = $stato;
        $this->citta = $citta;
        $this->localita = $localita;
    }

}