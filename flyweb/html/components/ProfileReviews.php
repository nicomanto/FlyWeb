<?php

namespace html\components;

use html\components\baseComponent;

use html\components\ProfileReviewItem;

use model\Review;

use \html\components\AverageBadgeVoteReview;

class ProfileReviews extends baseComponent {

    const _templateName = 'profile_reviews';

    private $Reviews;

    public function __construct($reviews) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->Reviews=$reviews;
        $this->render();
    }

    public function render(): string {

        $li="";

        foreach($this->Reviews as $i){
            $review= new Review($i);
            $li.= new ProfileReviewItem($review);
            
        }
        
        $this->replaceTag("REVIEW_ITEM",$li);

        return $this;
    }     
}