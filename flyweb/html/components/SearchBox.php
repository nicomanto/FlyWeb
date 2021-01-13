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
            $values['url'] = './search_landing.php';
            $values['filtri'] = 'filtri';
            $this->replaceTag('TITOLO', '');

        }else if($this->tipo == "searchbox"){
            $values['url'] = './search.php';
            $values['titolo'] = '';
            $this->replaceTag('TITOLO', '');

        }else{  //index searchbox
            $values['url'] = './search.php';
            $values['filtri'] = 'filtri-nascosti';
            $this->replaceTag('TITOLO', '<h1 class="titolo-pagina"><em>Benvenuto in flyweb, inizia qui il tuo viaggio!</em></h1>');
        }

        foreach ($this->values as $key => $value) {
            $values[$key] = $_GET[$key] ? $_GET[$key] : '';
        }

        $this->replaceValues($values);
        return $this;
    }
}