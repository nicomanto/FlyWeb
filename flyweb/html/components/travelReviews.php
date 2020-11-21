<?php

namespace html\components;

use html\components\baseComponent;

use html\components\travelReviewItem;

use model\Review;

class TravelReviews extends baseComponent {

    const _templateName = 'travel_reviews';
    private $list_review;
    private $n_reviews;
    private $avarage_reviews;

    public function __construct(array $list_review) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->list_review=$list_review;
        $this->n_reviews=0;
        $this->avarage_reviews=0;
        $this->render();
    }

    public function render(): string {

        $li="";

        foreach($this->list_review as $i){
            $review= new Review($i);
            
            if($review->mod!=0){ //controllo se la review è stata moderata
                $li.= new travelReviewItem($review);
                $this->n_reviews++;
                $this->avarage_reviews+=$review->valutazione;
            }
        }

        $this->avarage_reviews=$this->avarage_reviews/$this->n_reviews;

        $this->replaceValue('NUMERO_RECENSIONI',$this->n_reviews);
        $this->replaceValue('VOTO',$this->avarage_reviews);
        $this->replaceTag("TRAVEL_REVIEW_ITEM",$li);

        return $this;

    }
        
}