<?php

namespace html\components;

use \html\components\BaseComponent;

use \controllers\RouteController;;

class AdmDashBoard extends BaseComponent {

    const _templateName = "adm_dashboard";

    public function __construct() {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->render();
    }

    public function render(): string{

        $this->replaceValue('BASE', RouteController::BASE_ROUTE);
        $this->replaceValue('BASE_ADMIN', RouteController::ADMIN_BASE_ROUTE);

        $this->replaceTag('MENUADM', new \html\components\AdmMenuComponent());

        return $this;
    }
}