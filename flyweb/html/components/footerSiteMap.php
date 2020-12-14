<?php

namespace html\components;

use \html\components\PrincipalMenu;

use \model\UserMenu;

use \html\components\FooterSiteMapItem;

class FooterSiteMap extends NavMenu {

    public function __construct() {
        parent::__construct("footerSiteMap");
    }

    public function BuildMenuItem(){
        return (new \model\UserMenu())->build_menu($this->user);
    }

    public function TemplateMenuItem(): string{

        $li="";
        foreach($this->menuItem as $i){
            $li.=new \html\components\FooterSiteMapItem($i);
        }

        return $li;
    }
}

?>