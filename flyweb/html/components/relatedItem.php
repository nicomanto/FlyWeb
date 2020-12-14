<?php

namespace html\components;

use html\components\baseComponent;

class RelatedItem extends baseComponent {

    const _templateName = 'related_item';
    public $name;
    public $descrizione;
    public $id_viaggio;

    public function __construct($id_viaggio,$suggerimento,$descrizione) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);

        $this->id_viaggio=$id_viaggio;
        $this->name = $suggerimento;
        $this->descrizione=$descrizione;

        $this->render();
    }

    public function render(): string {

        $this->replaceValue("link","travel.php?id=".$this->id_viaggio);
        $this->replaceValue("descrizione",$this->descrizione);
        $this->replaceValue("suggerimento",$this->name);


        return $this;
    }
        
}