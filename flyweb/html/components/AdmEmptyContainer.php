<?php

namespace html\components;

use html\components\baseComponent;

class AdmEmptyContainer extends baseComponent {

    const _templateName = 'adm_empty_container';

    public function __construct($title) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->title=$title;

        // Render page
        $this->render();
    }

    public function render(): string {
        if($this->title=="LISTA VIAGGI"){
            $this->replaceValue('MESSAGGIO', "Nessun viaggio corrisponde alla ricerca");
        }
        else{
            $this->replaceValue('MESSAGGIO', "Nessuna recensione da moderare...per ora");
        }
        

        $this->replaceValue('LIST_TITLE', $this->title);
        return $this;
    }       
}