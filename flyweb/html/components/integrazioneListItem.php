<?php

namespace html\components;

use html\components\baseComponent;
use model\Integrazione;

class IntegrazioneListItem extends baseComponent {

    const _templateName = 'adm_integrazione_list_item';
    public $integrazione;

    public function __construct(array $integrazione) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);

        // Unpacking associative array (from db) into Travel
        $this->integrazione = new Integrazione($integrazione);

        // Render page
        $this->render();
    }

    public function render(): string {

        // Load travel properties into template
        $id = $this->integrazione->id_integrazione;

        $this->replaceValues([
                'id' => $this->integrazione->id_integrazione,
                'nome' => $this->integrazione->nome,
                'descrizione' => $this->integrazione->descrizione,
                'prezzo' => $this->integrazione->prezzo,
                'durata' => $this->integrazione->durata,
                'id' => $id
            ]
         );
        return $this;
    }
        
}