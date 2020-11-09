<?php

namespace html\components;

use \html\components\baseComponent;

class SignupForm extends baseComponent {

    const _templateName = 'signup_form';

    public function __construct() {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->render();
    }

    public function render(): string {
        // Eventually load login values from previous request
        $signupValuesKeys = ['name', 'surname', 'birth_date', 'username', 'email', 'password'];
        $signupValues = $this->loadValuesFromRequest($signupValuesKeys);
        $this->replaceValuesInTemplate($signupValuesKeys, $signupValues);

        return $this;
    }
}
