<?php

namespace html\components;

use html\components\baseComponent;
use model\BreadcrumbItem;

class Breadcrumb extends baseComponent {

    const _templateName = 'breadcrumb';
    private $breadcrumb_items;

    public function __construct(array $breadcrumb_items) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);

        $this->breadcrumb_items=$breadcrumb_items;

        $this->render();
    }

    public function render(): string {

        $breadcrumb="";
        $lastElement = end($this->breadcrumb_items);

        foreach($this->breadcrumb_items as $i){
            if($i->get_lang()!="it"){
                $breadcrumb.="<a href =\"".$i->get_path()."\" xml:lang=\"".$i->get_lang()."\">".$i->get_name()."</a>";
            }
            else{
                $breadcrumb.="<a href =\"".$i->get_path()."\">".$i->get_name()."</a>";
            }

            if($i!=$lastElement)
                $breadcrumb.=" > ";
            
        }
        $this->replaceValue("breadcrumb_items",$breadcrumb);


        return $this;
    }
        
}