<?php

namespace html\components;

use \html\components\baseComponent;
use controllers\RouteController;

class ResponseMessage extends baseComponent {

    const _templateName = 'response_message';
    private $message;
    private $link_page_return;
    private $name_page_to_return;
    private $span_en;


    /**
     * costruiscre una template response con
     * @param message il messaggio da visualizzare
     * @param link_page_return la pagina a cui ritornare dopo il response (settato ad index di default)
     * @param name_page_to_return nome della pagina da visualizzare (settato ad home di default)
     * @param span_en identifica se c'è da aggiungere uno span en (settato a true di default)
     */
    public function __construct(string $message,string $link_page_return="/index.php",string $name_page_to_return="Home",bool $span_en=true) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->message=$message;
        $this->link_page_return=$link_page_return;
        $this->name_page_to_return=$name_page_to_return;
        $this->span_en=$span_en;
        $this->render();
    }

    public function render(): string{

        $this->replaceValue('BASE', RouteController::BASE_ROUTE);
        $this->replaceValue('BASE_ADMIN', RouteController::ADMIN_BASE_ROUTE);

        $this->replaceValue("MESSAGGIO",$this->message);
        $this->replaceValue("LINK",$this->link_page_return);

        if($this->span_en)
            $this->replaceValue("PAGE","<span xml:lang=\"en\">".$this->name_page_to_return."</span>");
        else
            $this->replaceValue("PAGE",$this->name_page_to_return);
        
        return $this;
    }
}