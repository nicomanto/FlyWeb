<?php

namespace model;

class Order {
    public $id_ordine;
    public $id_utente;
    public $via;
    public $cap;
    public $provincia;
    public $note;
    public $comune;
    public $metodopagamento;
    public $totale;
    public $dataordine;

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
     * Maps values from array (used to convert db associative arrays into Order objects)
     */
    public function __construct1(array $order) {
        $timestamp = strtotime($order['DataOrdine']);
        $data_ordine = date("d/m/Y H:i:s", $timestamp);

        $this->id_ordine = $order['ID_Ordine'];
        $this->id_utente = $order['ID_Utente'];
        $this->via = $order['Via'];
        $this->cap = $order['Cap'];
        $this->provincia = $order['Provincia'];
        $this->note = $order['Note'];
        $this->comune = $order['Comune'];
        $this->metodopagamento = $order['MetodoPagamento'];
        $this->totale = $order['Totale'];
        $this->dataordine = $data_ordine;
    }



}