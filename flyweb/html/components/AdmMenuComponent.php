<?php

namespace html\components;

use \model\AdmMenu;

class AdmMenuComponent extends NavMenu {

    public function __construct() {
        parent::__construct("AdmMenu");
    }

    public function BuildMenuItem(){
        return (new AdmMenu())->build_menu($this->user);
    }

    public function TemplateMenuItem(): string{
        $li="";
        foreach($this->menuItem as $i){
            $li.=new AdmMenuItem($i);
        }

        return $li;
    }
}

?>
