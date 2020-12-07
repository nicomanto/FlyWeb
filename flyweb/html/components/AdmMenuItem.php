<?php

namespace html\components;

use \html\components\BaseComponent;
use controllers\RouteController;

class AdmMenuItem extends BaseComponent {

    const _templateName="adm_menu_item";

    private $itemMenu;

    public function __construct($itemMenu) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->itemMenu=$itemMenu;
        $this->render();
    }

    public function render(): string {

        $this->replaceValue('BASE', RouteController::BASE_ROUTE);
        $this->replaceValue('BASE_ADMIN', RouteController::ADMIN_BASE_ROUTE);

        $this->replaceValue('PAGE', $this->itemMenu->get_name());
        
        if($this->itemMenu->get_name()=="Logout")
            $this->replaceValue('JS', "onclick=\"admlogout()\"");
        else
            $this->replaceValue('JS', "");
        
        //controllare varibile di sessione per disattivare il link della pagina in cui ci si trova
        if(true)
            $this->replaceValue('LINK',"href=\"".$this->itemMenu->get_path()."\"");
        else
            $this->replaceValue('LINK',"");

        return $this;
    }
}