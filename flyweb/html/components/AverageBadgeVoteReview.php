<?php

namespace html\components;

use html\components\baseComponent;

class AverageBadgeVoteReview extends baseComponent {
    
    const _templateName = 'badge_review_vote';
    private $average;

    public function __construct($average) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->average=$average;
        $this->render();
    }

    public function render(): string{
        $this->replaceValue("VOTO",$this->average);
        return $this;
    }
        
}