<?php

namespace html\components;

use html\components\baseComponent;

use controllers\UserController;

use \html\components\SingleBadgeVoteReview;

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
            $li.=new stellaItem("yellow");
        }

        for($i=$this->review->valutazione;$i<5;$i++){
            $li.=new stellaItem();
        }
        
        $this->replaceTag('BADGE_VOTO', new \html\components\SingleBadgeVoteReview($this->review->valutazione));
        $this->replaceValue("TITOLO",$this->review->titolo);
        $this->replaceTag('STELLE_REVIEW', $li);
        $this->replaceValue("CONTENUTO",$this->review->descrizione);

        $user= new UserController($this->review->id_utente);
        $this->replaceValue("NOME_UTENTE",$user->user->nome);
        $this->replaceValue("COGNOME_UTENTE",$user->user->cognome);
        $this->replaceValue("DATA",$this->review->data);

        $idp = "p_".$this->review->id_recensione;


        if($_COOKIE['flw_user'] == 'admin'){
            $this->replaceValue("APPROVA",'
                    <input type="button" name="btn_approva" id="'.$this->review->id_recensione.'" value="APPORVA" onclick="approva(this.id)"> 
                    <p id="'.$idp.'"> </p>');

        }else{
            $this->replaceValue("APPROVA",'');
        }

        return $this;
    }
        
}