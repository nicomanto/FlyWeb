<?php

namespace html\components;

use \html\components\BaseComponent;


class CheckBoxItem extends BaseComponent {

    const _templateName = "checkbox_item";
    private $id;
    private $name;
    private $value;
    private $element_name;
    private $checked;

    public function __construct($id,$name,$value,$element_name,bool $checked=false) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);

        $this->id=$id;
        $this->name=$name;
        $this->value=$value;
        $this->element_name=$element_name;
        $this->checked=$checked;
        $this->render();
    }

    public function render(): string{

        $this->replaceValues([
            'ID' => $this->id,
            'NAME' => $this->name,
            'VALUE' => $this->value,
            'ELEMENT_NAME' => $this->element_name,
            'CHECKED' => $this->checked ? 'checked' : ""
        ]);

        return $this;
    }
}