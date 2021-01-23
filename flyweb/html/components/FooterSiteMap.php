<?php

namespace html\components;

use \model\UserMenu;

class FooterSiteMap extends NavMenu {

    public function __construct() {
        parent::__construct("footerSiteMap",false);
    }

    public function BuildMenuItem(){
        return (new UserMenu())->build_menu($this->user);
    }

    public function TemplateMenuItem(): string{

        $li="";
        foreach($this->menuItem as $i){
            $li.=new FooterSiteMapItem($i);
        }

        return $li;
    }
}

?>