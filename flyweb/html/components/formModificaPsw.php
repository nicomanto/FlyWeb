<?php

namespace html\components;

use \html\components\baseComponent;
use model\User;

class FormModificaPsw extends baseComponent {

    const _templateName = 'form_modifica_psw';
    public $user;

    public function __construct($user) {

        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->user = $user;
        $this->render();
    }
    

    public function render(): string {
        //echo "debug";
            $values = ['nuova_password'];
            $this->replaceValues([
                    'nuova_password' => $this->user->password
            ]);
            
            return $this;
    }

}