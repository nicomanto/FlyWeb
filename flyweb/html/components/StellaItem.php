<?php

namespace html\components;

use html\components\baseComponent;

class StellaItem extends baseComponent {

    const _templateName = 'stella_item';
    private $type_star;
    private $alt_star;

    public function __construct($type_star = "white") {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);

        $this->type_star = "img/star_".$type_star;

        if($type_star =="white")
            $this->alt_star="stella vuota bianca";
        else
            $this->alt_star="stella piena gialla";

        $this->render();
    }

    public function render(): string {

        $this->replaceValue("TYPE_ALT_STAR",$this->alt_star);
        $this->replaceValue("TYPE_STAR",$this->type_star);


        return $this;
    }
        
}