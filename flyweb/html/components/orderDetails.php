<?php

namespace html\components;

use html\components\baseComponent;

class OrderDetails extends baseComponent {

    public $order;

    const _templateName = 'order_details';

    public function __construct($order) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->order = $order;
        $this->render();
    }

    public function render(): string {
        $this->replaceValues([
            'id_ordine' => $this->order->id_ordine,
                'id_utente' => $this->order->id_utente,
                'via' => $this->order->via,
                'cap' => $this->order->cap,
                'provincia' => $this->order->provincia,
                'note' => $this->order->note,
                'comune' => $this->order->comune,
                'metodopagamento' => $this->order->metodopagamento,
                'totale' => $this->order->totale,
                'dataordine' => $this->order->dataordine,
        ]);
        return $this;
    }
        
}