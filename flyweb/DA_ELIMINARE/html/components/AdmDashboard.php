<?php

namespace html\components;

class AdmDashBoard extends BaseComponent {

    const _templateName = 'adm_dashboard';

    public function __construct() {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
    }

}
