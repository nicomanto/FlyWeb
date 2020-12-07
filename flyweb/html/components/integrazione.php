<?php

namespace html\components;

use \html\components\baseComponent;
use controllers\RouteController;
class Integrazione extends baseComponent {

    public $idViaggio;
    const _templateName = 'integrazione';

    public function __construct($idViaggio) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->idViaggio=$idViaggio;
        $this->render();
    }

    public function render(): string {

        $this->replaceValue('BASE', RouteController::BASE_ROUTE);
        $this->replaceValue('BASE_ADMIN', RouteController::ADMIN_BASE_ROUTE);
        $arr = ["idviaggio" => $this->idViaggio];
        $this->replaceValues($arr);
        return $this;
    }
}
