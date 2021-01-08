<?php

namespace html\components;

use html\components\baseComponent;

use controllers\UserController;

class RiepilogoOrdine extends baseComponent {

    private $userController;
    public $order;
    const _templateName = 'riepilogo';

    public function __construct(array $order) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->userController=$userController;
        $this->order = $order;
        $this->render();
    }

    public function render(): string {

        $this->replaceValues([
                'via' => $this->order["via"],
                'cap' => $this->order["cap"],
                'comune' => $this->order["comune"],
                'provincia' => $this->order["provincia"],
                'metodopagamento' =>$this->order["metodopagamento"]
                ]);

        return $this;
    }       
}