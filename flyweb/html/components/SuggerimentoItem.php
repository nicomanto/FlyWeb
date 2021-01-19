<?php

namespace html\components;

use html\components\baseComponent;

class SuggerimentoItem extends baseComponent {

    const _templateName = 'suggerimento_item';
    public $name;
    public $type;
    public $img;
    public $alt;


    public function __construct($suggerimento,$type,$img,$alt) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);

        $this->name = $suggerimento;
        $this->type=$type;
        $this->img =$img;
        $this->alt =$alt;

        $this->render();
    }

    public function render(): string {

        $this->replaceValue("link","./search.php?search_by_option=".urlencode( $this->type)."&search_key=".urlencode($this->name)."&search_start_date=&search_end_date=&search_start_price=&search_end_price=&search_order_by=&search_order_by_mode=&search=search");
        $this->replaceValue("img-tag", $this->img);
        $this->replaceValue("img-tag-title",$this->name);
        $this->replaceValue("ALT_IMAGE",$this->alt);
        $this->replaceValue("id",str_replace(" ", "", $this->name));
        $this->replaceValue("suggerimento",$this->name);
  


        return $this;
    }
        
}
?>