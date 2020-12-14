<?php

namespace html\components;

use \html\components\baseComponent;

class Integrazione extends baseComponent {

    public $idViaggio;
    const _templateName = 'integrazione';

    public function __construct($idViaggio=null) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->idViaggio=$idViaggio;
        $this->render();
    }

    public function render(): string {
        //echo "glo ".$this->idViaggio;
        $arr = ["idviaggio" => $this->idViaggio];
        $this->replaceValues($arr);
        return $this;
    }
}
