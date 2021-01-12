<?php

namespace html\components;

use \html\components\BaseComponent;

class AdmDashBoard extends BaseComponent {

    const _templateName = "adm_dashboard";

    public function __construct() {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->render();
    }

    public function render(): string{

        $this->replaceTag('MENUADM', new \html\components\AdmMenuComponent());

        return $this;
    }
}