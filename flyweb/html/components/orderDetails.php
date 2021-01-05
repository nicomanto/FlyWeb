<?php

namespace html\components;

use html\components\baseComponent;
use model\Order;

class OrderDetails extends baseComponent {

    public $order;
    public $data_type;

    const _templateName = 'order_details';

    public function __construct($order, $data_type) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->order = ($order);
        $this->data_type = ($data_type);
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
                'dataordine' => $this->order->dataordine
        ]);
        return $this;

    }
        
}