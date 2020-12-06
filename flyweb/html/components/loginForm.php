<?php

namespace html\components;

use \html\components\baseComponent;

class LoginForm extends baseComponent {

    const _templateName = 'login_form';

    public function __construct() {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->render();
    }
}
