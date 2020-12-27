<?php

namespace html\components;

use \html\components\baseComponent;
use \html\components\ErrorBox;

class LoginForm extends baseComponent {

    const _templateName = 'login_form';
    private $error;

    public function __construct(array $error) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->error=$error;
        $this->render();
    }

    public function render(): string {
        
        if(!empty($this->error)){

            $this->replaceTag('ERROR_BOX',new ErrorBox($this->error));
        }
        else{
            $this->replaceTag('ERROR_BOX','');
        }

        return $this;
    }
}
