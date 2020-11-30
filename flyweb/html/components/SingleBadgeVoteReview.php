<?php

namespace html\components;

use html\components\baseComponent;

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
        $this->replaceValue("VOTO",$this->valutazione);
        return $this;
    }
        
}