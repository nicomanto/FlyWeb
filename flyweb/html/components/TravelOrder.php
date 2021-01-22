<?php

namespace html\components;
use DateTime;
use controllers\TravelController;
use controllers\UserController;
use controllers\ImagesController;
use html\components\baseComponent;
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
            $this->replaceTag('BOTTONE_RECENSIONE','<p>Recensione già lasciata</p>');
        }
        else if($this->checkDateForReview($this->travel->data_fine)){
            $this->replaceTag('BOTTONE_RECENSIONE',
            '<form action="./inserimento_recensione.php" method="POST">
                <input type="hidden" name="id_viaggio" value="'.$this->travel->id_viaggio.'">

                <input type="submit" class="adm-bottone-approva-recensione" name="btn_approva" value="Lascia una recensione" >
            </form>');
        }
        else{
            $this->replaceTag('BOTTONE_RECENSIONE','<h2>Potrai lasciare una recensione dopo aver terminato il viaggio.</h2>');
        }

        
        

        //$this->replaceTag('REVIEWS_INDICATOR', (new \html\components\reviewsIndicator($this->travel)));
        
        return $this;
    }

    public function checkDateForReview($end_date){
        $today = new Datetime(date('Y-m-d'));
        return $today>new Datetime($end_date);
    }
}