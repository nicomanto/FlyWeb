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

        if($_COOKIE['flw_user'] == 'admin'){
            $this->replaceValue("approva",'
                <input type="hidden" name="par_id_approva" id="par_id_approva" value="'.$this->review->id_recensione.'"> 
                <input type="button" name="btn_approva" id="btn_approva" value="APPROVA" onclick="approva()"> 
                <p id="p_approvata"> </p>');

        }else{
            $this->replaceValue("approva",'');
        }

        return $this;
    }
        
}