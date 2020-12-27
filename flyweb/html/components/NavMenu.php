<?php

namespace html\components;

use \html\components\BaseComponent;

abstract class NavMenu extends BaseComponent {

    const _templateName1 = "navmenu";
    const _templateName2 = "footer_site_map";

    protected $user;
    protected $menuItem;
    protected $typeMenu;

    public function __construct($type,$footer=true){

        parent::__construct(($footer) ? self::_templateName1 : self::_templateName2);

        $this->typeMenu=$type;

        $this->user =$this->detectUserType();
        
        $this->menuItem=$this->BuildMenuItem();

        $this->render();
    }

    // abstract public function BuildMenuItem();

    // abstract public function TemplateMenuItem(): string;

    public function render(): string{

        $li=$this->TemplateMenuItem();

        $this->replaceValue("CLASS",$this->typeMenu);

        $this->replaceTag('NAVMENUITEM', $li);

        return $this;

    }

    protected function detectUserType(): string {
        $userType = '';
        if ($_SESSION['logged_in']) {
            $userType = 'LoggedUser';
        }
        
        if ($_SESSION['admin']) {
            $userType = 'LoggedAdmin';
        }
        
        if ($userType == '') {
            $userType = 'NotLoggedUser';
        }

        return $userType;
    }
}
