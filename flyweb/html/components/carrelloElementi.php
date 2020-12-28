<?php

namespace html\components;

use html\components\baseComponent;
use model\Travel;

class CarrelloElementi extends baseComponent {

    const _templateName = 'carrello_elementi';
    public $travel;

    public function __construct(array $travel) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);

        // Unpacking associative array (from db) into Travel
        $this->travel = new Travel($travel);

        // Render page
        $this->render();
    }

    public function render(): string {

        // Load travel properties into template
        $st = $this->travel->id_viaggio;

        // TODO: modificare il modifica
        $this->replaceValues([
                'id_viaggio' => $this->travel->id_viaggio,
                'name' => $this->travel->titolo,
                'long_desc' => $this->travel->descrizione,
                'price' => $this->travel->prezzo,
                'start_date' => $this->travel->data_inizio,
                'end_date' => $this->travel->data_fine,
                'country' => $this->travel->stato,
                'city' => $this->travel->citta,
                'location' => $this->travel->localita
            ]
        );

        //$this->replaceTag('REVIEWS_INDICATOR', (new \html\components\reviewsIndicator($this->travel)));
        
        return $this;
    }       
}