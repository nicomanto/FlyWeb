<?php

namespace html\components;

use html\components\baseComponent;

class NoReviews extends baseComponent {

    const _templateName = 'no_reviews';

    public function __construct() {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
    }        
}