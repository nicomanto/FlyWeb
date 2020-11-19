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

    public function render(): string {
        // Eventually load login values from cookie
        $loginValues = $this->loadValuesFromRequest(['user', 'password']);
        $loginValues['remember_me'] = $loginValues['user'] != '' ? "checked='checked'" : '';
        $this->replaceValues($loginValues);

        return $this;
    }
}
