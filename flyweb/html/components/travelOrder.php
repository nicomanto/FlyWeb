<?php

namespace html\components;

use html\components\baseComponent;

class TravelOrder extends baseComponent {

    public $travel;

    const _templateName = 'travel_order';

    public function __construct($travel) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->travel = $travel;
        $this->render();
    }

    public function render(): string {
        $this->replaceValues([
            'name' => $this->travel->titolo,
            'price' => $this->travel->prezzo,
            'start_date' => $this->travel->data_inizio,
            'end_date' => $this->travel->data_fine,
            'country' => $this->travel->stato,
            'city' => $this->travel->citta,
            'location' => $this->travel->localita
        ]);
        return $this;
    }
        
}