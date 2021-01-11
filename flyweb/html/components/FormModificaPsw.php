<?php

namespace html\components;

use \html\components\baseComponent;
use model\User;

class FormModificaPsw extends baseComponent {

    const _templateName = 'form_modifica_psw';
    public $user;
    private $error;

    public function __construct($user,array $error) {

        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->user = $user;
        $this->error=$error;
        $this->render();
    }
    

    public function render(): string {
        //echo "debug";
            $values = ['nuova_password'];
            $this->replaceValues([
                    'nuova_password' => $this->user->password
            ]);

            if(!empty($this->error)){
                $this->replaceTag('ERROR_BOX',new ErrorBox($this->error));
            }
            else{
                $this->replaceTag('ERROR_BOX','');
            }
            
            return $this;
    }

}