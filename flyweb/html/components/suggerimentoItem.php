<?php

namespace html\components;

use html\components\baseComponent;

class SuggerimentoItem extends baseComponent {

    const _templateName = 'suggerimento_item';
    public $name;
    public $type;
    public $img;


    public function __construct($suggerimento,$type,$img) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);

        $this->name = $suggerimento;
        $this->type=$type;
        $this->img =$img;

        $this->render();
    }

    public function render(): string {

        $this->replaceValue("link","search.php?search_by_option=".$this->type."&search_key=".$this->name."&search_start_date=&search_end_date=&search_start_price=&search_end_price=&search_order_by=&search_order_by_mode=&search=search");
        $this->replaceValue("img-tag", $this->img);
        $this->replaceValue("img-tag-title",$this->name);
        $this->replaceValue("id",str_replace(" ", "", $this->name));
        $this->replaceValue("suggerimento",$this->name);
  


        return $this;
    }
        
}
?>