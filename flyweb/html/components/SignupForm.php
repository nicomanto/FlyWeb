<?php

namespace html\components;

use \html\components\baseComponent;
use \html\components\ErrorBox;

class SignupForm extends baseComponent {

    const _templateName = 'signup_form';
    private $error;

    public function __construct(array $error) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->error=$error;
        $this->render();
    }

    public function render(): string {
        // Eventually load login values from previous request
        $signupValuesKeys = ['nome', 'cognome', 'data_nascita', 'username', 'email'];
        $signupValues = $this->loadValuesFromRequest($signupValuesKeys);
        $this->replaceValues($signupValues);
        
        if(!empty($this->error)){
            $this->replaceTag('ERROR_BOX',new ErrorBox($this->error));
        }
        else{
            $this->replaceTag('ERROR_BOX','');
        }

        return $this;
    }
}
