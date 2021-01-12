<?php

namespace html\components;

use html\components\baseComponent;

use controllers\UserController;

use model\Review;

class AdmTravelReviewItem extends baseComponent {

    const _templateName = 'adm_travel_review_item';
    private $review;

    public function __construct($review) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->review=$review;
        $this->render();
    }

    public function render(): string {

        $user= new UserController($this->review->id_utente);

        $this->replaceValues([
            "ID" => $this->review->id_recensione,
            "TITOLO" => $this->review->titolo,
            "DATA" => $this->review->data,
            "VALUTAZIONE" => $this->review->valutazione,
            "NOME_UTENTE" => $user->user->nome,
            "COGNOME_UTENTE" => $user->user->nome,
            "DESCRIZIONE" => $this->review->descrizione,
            "NOME_UTENTE" => $user->user->nome,
            "COGNOME_UTENTE" => $user->user->nome,
            "DATA" => $this->review->data,
            "LINGUA" => $this->review->lingua
        ]);
        return $this;
    }   
}