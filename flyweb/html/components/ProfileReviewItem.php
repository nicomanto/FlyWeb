<?php

namespace html\components;

use html\components\baseComponent;

use controllers\ReviewController;
use controllers\TravelController;

use \html\components\SingleBadgeVoteReview;

class ProfileReviewItem extends baseComponent {

    const _templateName = 'profile_review_item';
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
        
        $this->replaceTag('BADGE_VOTO', new SingleBadgeVoteReview($this->review->valutazione));
        $this->replaceValue("TITOLO",$this->review->titolo);
        $this->replaceValue("LINGUA",$this->review->lingua);
        $this->replaceTag('STELLE_REVIEW', $li);
        $this->replaceValue("CONTENUTO",$this->review->descrizione);

        $id_travel= (new ReviewController())->getIdTravel($this->review->id_recensione);
        $titolo_viaggio=(new TravelController($id_travel))->travel->titolo;
        
        $this->replaceValue("DATA",$this->review->data);
        $this->replaceValue("LINK","./travel.php?id=".$id_travel);
        $this->replaceValue("VIAGGIO",$titolo_viaggio);

        if($this->review->mod){
            $this->replaceTag('IS_MOD',"");
        }
        else{
            $this->replaceTag('IS_MOD',"<em class=\"no-rec\">Recensione ancora da moderare</em>");
        }
        

        return $this;
    }   
}