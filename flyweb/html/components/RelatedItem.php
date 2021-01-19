<?php

namespace html\components;

use html\components\baseComponent;

class RelatedItem extends baseComponent {

    const _templateName = 'related_item';
    public $name;
    public $descrizionebreve;
    public $img;
    public $id_viaggio;

    public function __construct($id_viaggio,$suggerimento,$descrizionebreve,$img=null) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);

        $this->id_viaggio=$id_viaggio;
        $this->name = $suggerimento;
        $this->descrizionebreve=$descrizionebreve;
        $this->img=$img;

        $this->render();
    }

    public function render(): string {

        $this->replaceValue("link","./travel.php?id=".$this->id_viaggio);
        $this->replaceValue("descrizionebreve",$this->descrizionebreve);
        $this->replaceValue("suggerimento",$this->name);
        $this->replaceValue("imgsrc",$this->img);

        return $this;
    }
        
}