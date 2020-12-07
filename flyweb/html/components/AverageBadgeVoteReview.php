<?php

namespace html\components;

use html\components\baseComponent;
use controllers\RouteController;

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

        $this->replaceValue('BASE', RouteController::BASE_ROUTE);
        $this->replaceValue('BASE_ADMIN', RouteController::ADMIN_BASE_ROUTE);
        $this->replaceValue("VOTO",$this->average);
        return $this;
    }
        
}