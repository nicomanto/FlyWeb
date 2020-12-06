<?php

namespace html\components;

use \html\components\NavMenu;

use \html\components\PrincipalMenuItem;

use \model\UserMenu;

class PrincipalMenu extends NavMenu {

    public function __construct() {
        parent::__construct("PrincipalMenu");
    }

    
    public function BuildMenuItem(){
        return (new \model\UserMenu)->build_menu($this->user);
    }

    public function TemplateMenuItem(): string{

        $li="";
        foreach($this->menuItem as $i){
            $li.=new \html\components\PrincipalMenuItem($i);
        }

        return $li;
    }
}