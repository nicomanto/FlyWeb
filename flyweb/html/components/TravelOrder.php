<?php

namespace html\components;
use DateTime;
use controllers\TravelController;
use controllers\UserController;
use controllers\ImagesController;
use html\components\baseComponent;
use html\components\ButtonReview;
use model\Travel;
use model\User;

class TravelOrder extends baseComponent {

    const _templateName = 'travel_order';
    public $travel;
    public $travel_controller;
    public $userController;

    public function __construct($travel) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);

        // Unpacking associative array (from db) into Travel
        $this->travel = new Travel($travel);
        $this->travel_controller=new TravelController((int)$this->travel->id_viaggio);
        $this->userController= new UserController();


        // Render page
        $this->render();
    }

    public function render(): string {

        // Load travel properties into template
        $st = $this->travel->id_viaggio;
        $imagesController = new ImagesController();

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
                'location' => $this->travel->localita,
                'travel_image' => $imagesController->getImagePath($this->travel->immagine),
                'travel_image_name' => $this->travel->altImmagine
            ]
        );

        if($this->travel_controller->haveUserReview((int)$this->userController->user->id_utente)){
            $this->replaceTag('BOTTONE_RECENSIONE','<em class="no-rec">Recensione già lasciata</em>');
        }
        else if($this->checkDateForReview($this->travel->data_fine)){
            $this->replaceTag('BOTTONE_RECENSIONE', new ButtonReview($this->travel->id_viaggio));
        }
        else{
            $this->replaceTag('BOTTONE_RECENSIONE','<em class="no-rec">Potrai lasciare una recensione solo dopo aver terminato il viaggio!</em>');
        }

        
        

        //$this->replaceTag('REVIEWS_INDICATOR', (new \html\components\reviewsIndicator($this->travel)));
        
        return $this;
    }

    public function checkDateForReview($end_date){
        $timestamp = strtotime(str_replace('/', '-', $end_date));
        $end_date=date("Y-m-d", $timestamp);

        $today = new Datetime();
        return $today>new Datetime($end_date);
    }
}