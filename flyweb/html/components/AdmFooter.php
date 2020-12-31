<?php

namespace html\components;

use \html\components\BaseComponent;


class AdmFooter extends BaseComponent {

    const _templateName = 'adm_footer';

    public function __construct() {
        parent::__construct(self::_templateName);
    }
}

