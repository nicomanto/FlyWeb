<?php

namespace html\components;

use html\components\baseComponent;

use html\components\TravelReviewItem;

use model\Review;

use \html\components\AverageBadgeVoteReview;

class TravelReviews extends baseComponent {

    const _templateName = 'travel_reviews';

    private $travelController;

    public function __construct($travelController) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->travelController=$travelController;
        $this->render();
    }

    public function render(): string {

        $li="";

        foreach($this->travelController->getTravelReviewsList() as $i){
            $review= new Review($i);
            
            if($review->mod!=0) //controllo se la review è stata moderata
                $li.= new TravelReviewItem($review);
            
        }

        $this->replaceValue('NUMERO_RECENSIONI',$this->travelController->getNumberOfReviews());
        $this->replaceTag('BADGE_VOTO',new AverageBadgeVoteReview($this->travelController->getAverageReviews()));
        $this->replaceTag("REVIEW_ITEM",$li);

        return $this;
    }     
}