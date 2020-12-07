<?php

namespace html\components;

use \html\components\baseComponent;
use controllers\RouteController;

class SignupForm extends baseComponent {

    const _templateName = 'signup_form';

    public function __construct() {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->render();
    }

    public function render(): string {

        $this->replaceValue('BASE', RouteController::BASE_ROUTE);
        $this->replaceValue('BASE_ADMIN', RouteController::ADMIN_BASE_ROUTE);
        
        // Eventually load login values from previous request
        $signupValuesKeys = ['nome', 'cognome', 'data_nascita', 'username', 'email', 'password'];
        $signupValues = $this->loadValuesFromRequest($signupValuesKeys);
        $this->replaceValues($signupValues);

        return $this;
    }
}
