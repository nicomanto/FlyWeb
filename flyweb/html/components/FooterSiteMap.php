<?php

namespace html\components;

use PrincipalMenu;

use \model\UserMenu;


class FooterSiteMap extends NavMenu {

    public function __construct() {
        parent::__construct("footerSiteMap",false);
    }

    public function BuildMenuItem(){
        return (new \model\UserMenu())->build_menu($this->user);
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