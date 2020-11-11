<?php

namespace html\components;

use \html\components\BaseComponent;

use \model\Menu;

class NavMenu extends BaseComponent {

    const _templateName = "navmenu";

    public function __construct(string $user) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->addMenu($user);
    }

    public function addMenu(string $user): void{

        $menu=(new Menu())->build_menu($user);

        $li="";

        foreach($menu as $i){
            if($i->get_name()=="Home" || $i->get_name()=="Login" || $i->get_name()=="Sign in" || $i->get_name()=="About us" ||$i->get_name()=="Log out")
                $li.="<li xml:lang=\"en\"><a href=\"".$i->get_path()."\">".$i->get_name()."</li>";
            else
                $li.="<li><a href=\"".$i->get_path()."\">".$i->get_name()."</li>";
        }

        $this->replaceTag('NAVMENUITEM', $li);

    }
}

?>