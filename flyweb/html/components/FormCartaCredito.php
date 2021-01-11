<?php

namespace html\components;

use \html\components\BaseComponent;

class FormCartaCredito extends BaseComponent {

    const _templateName = "form_carta_credito";

    public function __construct() {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->render();
    }

    public function render(): string{

        $this->replaceValues([
            'metodopagamento' => $_POST['metodopagamento']

    ]);

        return $this;
    }
}