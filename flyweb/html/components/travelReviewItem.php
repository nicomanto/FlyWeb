<?php

namespace html\components;

use html\components\baseComponent;

use controllers\UserController;

class TravelReviewItem extends baseComponent {

    const _templateName = 'travel_review_item';
    private $review;

    public function __construct($review) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->review=$review;
        $this->render();
    }

    public function render(): string {

        $li="";

        for($i=0;$i<$this->review->valutazione;$i++){
            $li.=new StellaItem("yellow");
        }

        for($i=$this->review->valutazione;$i<5;$i++){
            $li.=new StellaItem();
        }


        $this->replaceValue("N_STAR",$this->review->valutazione);
        $this->replaceValue("TITOLO",$this->review->titolo);
        $this->replaceTag('STELLE_REVIEW', $li);
        $this->replaceValue("CONTENUTO",$this->review->descrizione);

        $user= new UserController($this->review->id_utente);
        $this->replaceValue("NOME_UTENTE",$user->user->nome);
        $this->replaceValue("COGNOME_UTENTE",$user->user->cognome);
        $this->replaceValue("DATA",$this->review->data);

        return $this;
    }
        
}