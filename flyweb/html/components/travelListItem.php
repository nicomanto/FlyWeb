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
        $this->travel = new Travel($travel);

        // Render page
        $this->render();
    }

    public function render(): string {

        $continueReading = '... <a href=travel?id=' . $this->travel->id_viaggio . '>continua a leggere</a>';

        // Load travel properties into template
        $nome = strlen($this->travel->nome) > 30 ? substr($this->travel->nome, 0, 30) . '...' : $this->travel->nome;
        $descrizione = strlen($this->travel->descrizione) > 200 ? substr($this->travel->descrizione, 0, 200) . $continueReading : $this->travel->descrizione;

        $this->replaceValues([
                'travel_id' => $this->travel->id_viaggio,
                'travel_name' => $nome,
                'travel_description' => $descrizione,
                'travel_price' => $this->travel->prezzo,
                'travel_start_date' => $this->travel->data_inizio,
                'travel_end_date' => $this->travel->data_fine,
                'travel_country' => $this->travel->stato,
                'travel_city' => $this->travel->city,
                'travel_location' => $this->travel->location
            ]
        );

        return $this;
    }
        
}