<?php

namespace html\components;

use \html\components\BaseComponent;

use \model\Menu;

class NavMenu extends BaseComponent {

    const _templateName = "navmenu";

    public function __construct() {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->addMenu();
    }

    public function __construct1(string $templateName) {
        // Call BaseComponent constructor
        parent::__construct($templateName);
        $this->addMenu();
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

        $this->replaceTag('NAVMENUITEM', $li);

    }

    protected function detectUserType(): string {
        $userType = '';
        if ($_SESSION['logged_in']) {
            $userType = 'LoggedUser';
        } else {
            $userType = 'NotLoggedUser';
        }

        return $userType;
    }
}

?>