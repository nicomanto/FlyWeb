<?php

namespace html\components;

use html\components\baseComponent;
use controllers\RouteController;

class SingleBadgeVoteReview extends baseComponent {

    const _templateName = 'badge_review_vote';
    private $valutazione;

    public function __construct($valutazione) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->valutazione=$valutazione;
        $this->render();
    }

    public function render(): string{

        $this->replaceValue('BASE', RouteController::BASE_ROUTE);
        $this->replaceValue('BASE_ADMIN', RouteController::ADMIN_BASE_ROUTE);

        $this->replaceValue("VOTO",$this->valutazione);
        return $this;
    }
        
}