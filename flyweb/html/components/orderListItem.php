<?php

namespace html\components;

use html\components\baseComponent;
use model\Order;

class OrderListItem extends baseComponent {

    const _templateName = 'order_list_item';
    public $order;

    public function __construct(array $order) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        // Unpacking associative array (from db) into Travel
        $this->order = new Order($order);
       

        // Render page
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
            ]
         );
        return $this;
    }
        
}