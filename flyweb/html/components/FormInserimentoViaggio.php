<?php

namespace html\components;

use \html\components\baseComponent;

class FormInserimentoViaggio extends baseComponent {

    const _templateName = 'adm_form_inserimento_viaggio';

    public function __construct() {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
    }
}
