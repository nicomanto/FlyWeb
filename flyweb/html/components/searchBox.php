<?php

namespace html\components;

use html\components\baseComponent;

class SearchBox extends baseComponent {
    const _templateName = 'search_box';
    private $values = [
        'search_by_option' => '',
        'search_key' => '',
        'search_start_date' => '',
        'search_end_date' => '',
        'search_start_price' => '',
        'search_end_price' => '',
        'search_order_by' => '',
        'search_order_by_mode' => ''
    ];

    private $tipo;

    public function __construct($tipo=null) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->tipo = $tipo;
        $this->render();
    }

    public function render(): string {
    
        if($this->tipo == "adm-searchbox"){
            $values['url'] = './adm_search_landing.php';
            $values['titolo'] = '<h1 class="adm-titolo">CERCA I VIAGGI DA MODIFICARE O ELIMINARE</h1>';
        }else if($this->tipo == "searchbox"){
            $values['url'] = './search.php';
            $values['titolo'] = '<h1>CERCA VIAGGI</h1>';
        }else{
            $values['url'] = './search.php';
            $values['titolo'] = '';
        }

        foreach ($this->values as $key => $value) {
            $values[$key] = $_GET[$key] ? $_GET[$key] : '';
        }

        $this->replaceValues($values);
        return $this;
    }
}