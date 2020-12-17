<?php

namespace html\components;

use \controllers\BoxRelatedController;

class BoxRelated extends baseComponent {

    const _templateName = "box_related";
    private $id_tag;
    private $id_viaggio;
    private $num_sugg;
    private $controller;

    public function __construct($id_tag, $id_viaggio, int $num_sugg=4) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->id_tag=$id_tag;
        $this->id_viaggio=$id_viaggio;
        $this->num_sugg=$num_sugg;
        $this->controller = new  \controllers\BoxRelatedController($this->id_tag,$this->id_viaggio);
        $this->addTag();

    }

    public function addTag(): void{
        $lista_sugg="";
        foreach ($this->controller->get_related() as $i){
            $lista_sugg.=new relatedItem($i['ID_Viaggio'],$i['Titolo'], substr($i['Descrizione'],0,150)."...continua");
        }

        $this->replaceTag('SUGGERIMENTO', $lista_sugg);

    }
    
}
