<?php

namespace html\components;

use \html\components\baseComponent;

class ButtonReview extends baseComponent {

    const _templateName = 'button_review';
    private $id_viaggio;

    public function __construct(int $id_viaggio) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->id_viaggio=$id_viaggio;
        $this->render();
    }

    public function render(): string {

        $this->replaceValue("ID_VIAGGIO",$this->id_viaggio);

        return $this;
    }
}