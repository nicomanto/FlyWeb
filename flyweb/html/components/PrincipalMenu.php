<?php

namespace html\components;

use \html\components\NavMenu;

class PrincipalMenu extends NavMenu {

    public function __construct() {
        parent::__construct("main-menu");
    }

    
    public function BuildMenuItem(){
        return (new \model\UserMenu)->build_menu($this->user);
    }

    public function TemplateMenuItem(): string{

        $li="";
        foreach($this->menuItem as $i){
            $li.=new PrincipalMenuItem($i);
        }

        return $li;
    }
}