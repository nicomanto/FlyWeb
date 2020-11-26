<?php

namespace html\components;

use html\components\baseComponent;

use controllers\UserController;

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

        $this->replaceValue("ID",$this->review->id_recensione);
        $this->replaceValue("TITOLO",$this->review->titolo);
        $this->replaceValue("DATA",$this->review->data);
        $this->replaceValue("VALUTAZIONE",$this->review->valutazione);
        $this->replaceValue("NOME_UTENTE",$user->user->nome);
        $this->replaceValue("COGNOME_UTENTE",$user->user->nome);
        $this->replaceValue("DESCRIZIONE",$this->review->descrizione);

        $this->replaceValue("NOME_UTENTE",$user->user->nome);
        $this->replaceValue("COGNOME_UTENTE",$user->user->nome);
        $this->replaceValue("DATA",$this->review->data);

        if($_COOKIE['flw_user'] == 'admin'){
            $this->replaceValue("APPROVA",'
                <div class="adm-card-rev">
                    <input type="button" class="adm-bottone-modifica-card" name="btn_approva" id="'.$this->review->id_recensione.'" value="APPORVA" onclick="approva(this.id)"> 
                    <p id="'.$idp.'"> </p>
                </div>
            ');
        }else{
            $this->replaceValue("APPROVA",'');
        }

        return $this;
    }   
}