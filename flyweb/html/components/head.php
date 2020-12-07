<?php

namespace html\components;

use controllers\RouteController;

class Head extends BaseComponent {

    const _templateName = 'head';

    public function __construct() {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->render();
    }

    public function render(): string {

        $this->replaceValue('BASE', RouteController::BASE_ROUTE);
        $this->replaceValue('BASE_ADMIN', RouteController::ADMIN_BASE_ROUTE);
        $this->replaceValue('BASE', RouteController::BASE_ROUTE);
        return $this;
    }

}
