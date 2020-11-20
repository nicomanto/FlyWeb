<?php

namespace html\components;

use \html\components\NavMenu;

use \model\Menu;

class FooterSiteMap extends NavMenu {

    const _templateName = "footer_site_map";

    public function __construct() {
        parent::__construct1(self::_templateName);
    }

    public function addMenu(): void{

        $user = $this->detectUserType();

        $menu=(new Menu())->build_menu($user);

        $li="";

        foreach($menu as $i){
            if($i->get_name()=="Home" || $i->get_name()=="Login" || $i->get_name()=="Sign in" || $i->get_name()=="About us" ||$i->get_name()=="Log out")
                $li.="<li xml:lang=\"en\"><a href=\"".$i->get_path()."\">".$i->get_name()."</a></li>";
            else
                $li.="<li><a href=\"".$i->get_path()."\">".$i->get_name()."</a></li>";
        }

        $this->replaceTag('FOOTERMENUITEM', $li);
    

    }
}

?>