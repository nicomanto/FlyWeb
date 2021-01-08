<?php

namespace html\components;

use controllers\ImagesController;
use html\components\baseComponent;

class TravelDetails extends baseComponent {

    public $travel;

    const _templateName = 'travel_details';

    public function __construct($travel) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->travel = $travel;
        $this->render();
    }

    public function render(): string {
        $imagesController = new ImagesController();

        $this->replaceValues([
            'name' => $this->travel->titolo,
            'long_desc' => $this->travel->descrizione,
            'price' => $this->travel->prezzo,
            'start_date' => $this->travel->data_inizio,
            'end_date' => $this->travel->data_fine,
            'country' => $this->travel->stato,
            'city' => $this->travel->citta,
            'location' => $this->travel->localita,
            'travel_image' => $imagesController->getImagePath($this->travel->immagine),
            'travel_image_name' => $imagesController->getImageName($this->travel->immagine),  
        ]);
        return $this;
    }
        
}