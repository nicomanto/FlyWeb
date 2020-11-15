<?php

namespace html\components;

class AdmSuccessoInserimento extends BaseComponent {

    const _templateName = 'adm_successo_inserimento';

    public function __construct($titolo) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->render($titolo);
    }

    public function render($titolo): string {
        
        $value = ['titolo'=>$titolo];
        $this->replaceValuesInTemplate($value);
        return $this;
    }

}
