<?php

namespace html\components;

use html\components\baseComponent;

class Subtotale extends baseComponent {
    
    const _templateName = 'subtotale';
    private $sub;

    public function __construct($sub) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->sub=$sub;
        $this->render();
    }

    public function render(): string{
        $this->replaceValue("SUB",$this->sub);
        return $this;
    }
        
}