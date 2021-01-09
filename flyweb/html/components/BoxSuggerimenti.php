<?php

namespace html\components;

use controllers\BoxSuggerimentiController;

class BoxSuggerimenti extends baseComponent {

    const _templateName = "box_suggerimenti";
    protected $controller;
    protected $type;

    public function __construct(int $num_sugg=4, string $type="Tag") {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->controller = new BoxSuggerimentiController($num_sugg, $type);
        $this->type = $type;
        $this->addTag();
    }

    public function addTag(): void{
        $lista_sugg="";
        foreach ($this->controller->get_suggerimenti() as $i){
            $lista_sugg.=new suggerimentoItem($i['Nome'], $this->type, $i['Immagine']);
        }

        $this->replaceTag('SUGGERIMENTO', $lista_sugg);

    }
}

?>
