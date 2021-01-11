<?php

namespace html\components;

use html\components\baseComponent;

class EliminazioneProfilo extends baseComponent {
    
    const _templateName = 'eliminazione_profilo';

    public function __construct() {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->render();
    }

    public function render(): string{
     
        return $this;
   }
        
}