<?php

namespace html\components;

use html\components\baseComponent;
use BreadcrumbItem;

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

            $i_lang = $i->get_lang();

            if ($i == $lastElement) {

                $breadcrumb .= "<span";

                // Add language if needed
                if ($i_lang != "it") {
                    $breadcrumb .= " lang=\"" . $i->get_lang() . "\""; 
                }

                $breadcrumb .= ">" . $i->get_name() . "</span>";
            } else {

                $breadcrumb .= "<a href=\"" . $i->get_path() .  "\"";

                // Add language if needed
                if ($i_lang != "it") {
                    $breadcrumb .= " lang=\"" . $i->get_lang() . "\""; 
                }

                $breadcrumb .= ">" . $i->get_name() . "</a> > ";
            }
        
        }
        $this->replaceValue("breadcrumb_items",$breadcrumb);


        return $this;
    }
        
}