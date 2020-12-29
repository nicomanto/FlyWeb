<?php

namespace html\components;

class MetodoPagamento extends BaseComponent {

    const _templateName = "metodo_pagamento";

    public function __construct() {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->render();
    }

    public function render(): string{


        return $this;
    }
}