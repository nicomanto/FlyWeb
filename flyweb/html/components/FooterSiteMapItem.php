<?php

namespace html\components;

use \html\components\BaseComponent;

class FooterSiteMapItem extends BaseComponent {

    const _templateName="footer_site_map_item";

    private $itemMenu;

    public function __construct($itemMenu) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->itemMenu=$itemMenu;
        $this->render();
    }

    public function render(): string {

        $lang = $this->itemMenu->get_lang()!="it" ? "lang=\"".$this->itemMenu->get_lang()."\"" : "";
        $name = $this->itemMenu->get_name();
        $path = $this->itemMenu->get_path();

        //controllare variabile di sessione per disattivare il link della pagina in cui ci si trova
        if(substr($_SERVER['SCRIPT_FILENAME'], -(strlen($path) - 1)) != substr($path, 1)) {
            $item = "<a href=\"$path\">$name</a>";
        } else {
            $item = "<span>$name</span>";
        }

        $this->replaceValues([
            "ITEM" => $item,
            "LANG" => $lang
        ]);
        

        return $this;
    }
}