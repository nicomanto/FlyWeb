<?php

namespace html\components;

use controllers\ImagesController;
use html\components\baseComponent;
use model\Travel;
<<<<<<< HEAD

=======
>>>>>>> 66109ab8a5257fe1917b11574792732be14e41d5

class CarrelloElementi extends baseComponent {

    const _templateName = 'carrello_elementi';
    public $travel;
    public $id_elemento_carrello;

    public function __construct(array $travel, $id_elemento_carrello) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);

        // Unpacking associative array (from db) into Travel
        $this->travel = new Travel($travel);
        $this->id_elemento_carrello = $id_elemento_carrello;

        // Render page
        $this->render();
    }

    public function render(): string {

        // Load travel properties into template
        $st = $this->travel->id_viaggio;
        $imageController = new ImagesController();

        

        // TODO: modificare il modifica
        $this->replaceValues([
                'id_viaggio' => $this->travel->id_viaggio,
                'id_elemento_carrello' => $this->id_elemento_carrello,
                'name' => $this->travel->titolo,
                'long_desc' => $this->travel->descrizione,
                'price' => $this->travel->prezzo,
                'start_date' => $this->travel->data_inizio,
                'end_date' => $this->travel->data_fine,
                'country' => $this->travel->stato,
                'city' => $this->travel->citta,
                'location' => $this->travel->localita,
<<<<<<< HEAD
                'travel_image' => $imageController->getImagePath($this->travel->immagine),
                'travel_image_name' => $imageController->getImageName($this->travel->immagine)
=======
                'travel_image' => $imagesController->getImagePath($this->travel->immagine),
                'travel_image_name' => $this->travel->altImmagine
>>>>>>> 66109ab8a5257fe1917b11574792732be14e41d5
            ]
        );
        
        return $this;
    }       
}