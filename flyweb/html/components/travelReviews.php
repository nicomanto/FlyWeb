<?php

namespace html\components;

use html\components\baseComponent;
use html\components\travelReviewItem;
use model\Review;
use controllers\RouteController;

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

        $this->replaceValue('BASE', RouteController::BASE_ROUTE);
        $this->replaceValue('BASE_ADMIN', RouteController::ADMIN_BASE_ROUTE);

        $li="";

        foreach($this->travelController->getTravelReviewsList() as $i){
            $review= new Review($i);
            
            if($review->mod!=0) //controllo se la review è stata moderata
                $li.= new travelReviewItem($review);
            
        }

        $this->replaceValue('NUMERO_RECENSIONI',$this->travelController->getNumberOfReviews());
        $this->replaceTag('BADGE_VOTO',new \html\components\AverageBadgeVoteReview($this->travelController->getAverageReviews()));
        $this->replaceTag("TRAVEL_REVIEW_ITEM",$li);

        return $this;

    }
        
}