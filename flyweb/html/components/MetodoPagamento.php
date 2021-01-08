<?php

namespace html\components;

use \html\components\BaseComponent;
use model\Order;

class MetodoPagamento extends baseComponent
{

    public $ordine;

    const _templateName = 'metodo_pagamento';

    public function __construct()
    {

        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->ordine = $ordine;
        $this->render();
    }


    public function render(): string
    {
        //echo "debug";
        $this->replaceValues([
            'metodopagamento' => $this->order->metodopagamento
        ]);
        return $this;
    }

    //estrae i dati inseriti nel form e li mette in un array associativo
    public function estraiMetodoPagamento(): array
    {
        $dati = [
            'metodopagamento' => $_POST['metodopagamento']
        ];

        return $dati;
    }
}
