<?php

namespace html\components;

class Head extends BaseComponent {

    const _templateName = 'head';

    public function __construct() {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
    }

}
