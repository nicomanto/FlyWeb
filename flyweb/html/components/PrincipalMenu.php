<?php

namespace html\components;

use model\UserMenu;

class PrincipalMenu extends NavMenu {

    public function __construct() {
        parent::__construct("main-menu");
    }

    
    public function BuildMenuItem(){
        return (new UserMenu)->build_menu($this->user);
    }

    public function TemplateMenuItem(): string{

        $li="";
        foreach($this->menuItem as $i){
            $li.=new PrincipalMenuItem($i);
        }

        return $li;
    }
}