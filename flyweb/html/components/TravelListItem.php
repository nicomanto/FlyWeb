<?php

namespace html\components;

use controllers\ImagesController;
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

        // Load travel properties into template
        $st = $this->travel->id_viaggio;

        $imagesController = new ImagesController();
        print_r($this->travel);

        // TODO: modificare il modifica
        $this->replaceValues([
                'travel_id' => $this->travel->id_viaggio,
                'travel_title' => $this->travel->titolo,
                'travel_description' => (strlen($this->travel->descrizioneBreve)<=200)?$this->travel->descrizioneBreve:substr($this->travel->descrizioneBreve,0,200)."...",
                'travel_price' => $this->travel->prezzo,
                'travel_start_date' => $this->travel->data_inizio,
                'travel_end_date' => $this->travel->data_fine,
                'travel_country' => $this->travel->stato,
                'travel_city' => $this->travel->city,
                'travel_location' => $this->travel->location,
                'travel_image' => $imagesController->getImagePath($this->travel->immagine),
                'travel_image_name' => $imagesController->getImageName($this->travel->immagine)
            ]
        );

        //$this->replaceTag('REVIEWS_INDICATOR', (new \html\components\reviewsIndicator($this->travel)));
        
        return $this;
    }       
}