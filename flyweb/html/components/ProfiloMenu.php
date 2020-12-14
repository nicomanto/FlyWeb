<?php

namespace html\components;

use \html\components\BaseComponent;

use \model\MenuProfilo;

class ProfiloMenu extends BaseComponent {

    const _templateName = "profilomenu";

    public function __construct() {
        parent::__construct(self::_templateName);
        $this->addMenuprofilo();
    }
    public function __construct1(string $templateName) {
        parent::__construct($templateName);
        $this->addMenuprofilo();
    }

    public function addMenuprofilo(): void{

        $user = $this->detectUserType();

        $menu=(new MenuProfilo())->build_menu($user);

        $li="";

        foreach($menu as $i){
            if($i->get_name()=="Dati Personali" || $i->get_name()=="Ordini"  || $i->get_name()=="Recensioni")
                $li.="<li xml:lang=\"en\"><a href=\"".$i->get_path()."\">".$i->get_name()."</a></li>";
            else
                $li.="<li><a href=\"".$i->get_path()."\">".$i->get_name()."</a></li>";
        }

        $this->replaceTag('PROFILOMENUITEM', $li);
    

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