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

        if($_SESSION['admin']){
            $this->replaceValue("APPROVA",'
                <div class="adm-card-rev">
                    <input type="button" class="adm-bottone-approva-recensione" name="btn_approva" id="'.$this->review->id_recensione.'i" value="APPORVA" onclick="approva(this.id)"> 
                    <input type="button" class="adm-bottone-elimina-recensione" name="btn_approva" id="'.$this->review->id_recensione.'e" value="ELIMINA" onclick="elimina(this.id)"> 
                </div> ');
        }else{
            $this->replaceValue("APPROVA",'');
        }
        return $this;
    }   
}