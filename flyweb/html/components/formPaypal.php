<?php

namespace html\components;

use \html\components\BaseComponent;

class FormPaypal extends BaseComponent {

    const _templateName = "form_paypal";

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