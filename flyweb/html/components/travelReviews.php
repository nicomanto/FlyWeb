<?php

namespace html\components;

use html\components\baseComponent;

use html\components\TravelReviewItem;

use model\Review;

class TravelReviews extends baseComponent {

    const _templateName = 'travel_reviews';
    private $list_review;

    public function __construct(array $list_review) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->list_review=$list_review;
        $this->render();
    }

    public function render(): string {

        $li="";
        foreach($this->list_review as $i){
            $li.= new TravelReviewItem(new Review($i));
        }

        $this->replaceTag("TRAVEL_REVIEW_ITEM",$li);
        return $this;
    }
        
}