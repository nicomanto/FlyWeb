<?php

namespace html\components;

use \html\components\NavMenu;

use \model\AdmMenu;

class AdmMenuComponent extends NavMenu {

    const _templateName = "adm_menu";

    public function __construct() {
        parent::__construct(self::_templateName);
    }

    public function BuildMenuItem(){
        return (new AdmMenu())->build_menu($this->user);
    }

    public function TemplateMenuItem(): string{
        $li="";
        foreach($this->menuItem as $i){
            $li.=new \html\components\AdmMenuItem($i);
        }

        return $li;
    }
}

?>
