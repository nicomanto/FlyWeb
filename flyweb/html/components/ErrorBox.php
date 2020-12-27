<?php

namespace html\components;

use \html\components\baseComponent;

class ErrorBox extends baseComponent {

    const _templateName = 'error_box';
    private $error;

    public function __construct(array $error) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->error=$error;
        $this->render();
    }

    public function render(): string {
        $error_message="";
        foreach($this->error as $i){
            $error_message.="<li>".$i."</li>";
        }

        $this->replaceValue("list_error",$error_message);

        return $this;
    }
}