<?php

namespace html\components;

use html\components\baseComponent;
use model\Travel;

class TravelListItem extends baseComponent {

    const _templateName = 'travel_list_item';
    public $travel;

    public function __construct(array $travel) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);

        // Unpacking associative array (from db) into Travel
        $this->travel = new Travel($travel['Nome'], $travel['DataInizio'], $travel['DataFine'], $travel['Prezzo'], $travel['Descrizione']);

        // Render page
        $this->render();
    }

    public function render(): string {
        // Load travel properties into template
        $this->replaceValuesInTemplate([
                'travel_name' => $this->travel->nome,
                'travel_description' => $this->travel->descrizione,
                'travel_price' => $this->travel->prezzo,
                'travel_start_date' => $this->travel->data_inizio,
                'travel_end_date' => $this->travel->data_fine
            ]
        );

        return $this;
    }
        
}