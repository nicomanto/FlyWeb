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
            $values['filtri'] = 'filtri-si';
            $this->replaceTag('TITOLO', '');

        }else if($this->tipo == "searchbox"){
            $values['url'] = './search.php';
            $values['titolo'] = '';
            $values['filtri'] = 'filtri-no';
            $this->replaceTag('TITOLO', '');

        }else{  //index searchbox
            $values['url'] = './search.php';
            $values['filtri'] = 'filtri-no';
            $this->replaceTag('TITOLO', '<h1 class="titolo-pagina"><em>Benvenuto in flyweb, inizia qui il tuo viaggio!</em></h1>');
        }

        // Populate form
        foreach ($this->values as $key => $value) {
            $values[$key] = $_GET[$key] ? $_GET[$key] : '';
        }

        // Build search type options list
        $search_type_options = ['Tutto', 'Citta', 'Tag'];
        $search_type_options_html = '';
        foreach ($search_type_options as $option) {
            $search_type_options_html .= "<option value=\"$option\"";
            
            if ($_GET['search_by_option'] == $option) {
                $search_type_options_html .= "selected=\"selected\"";
            }

            $search_type_options_html .= ">$option</option>";
        }

        $values['SEARCH_TYPE_OPTIONS'] = $search_type_options_html;

        // Build order type options list
        $order_type_options = ['Prezzo', 'Data inizio', 'Data fine'];
        $order_type_options_html = '';
        foreach ($order_type_options as $option) {
            $order_type_options_html .= "<option value=\"$option\"";
            
            if ($_GET['search_order_by'] == $option) {
                $order_type_options_html .= "selected=\"selected\"";
            }

            $order_type_options_html .= ">$option</option>";
        }

        $values['ORDER_TYPE_OPTIONS'] = $order_type_options_html;

        // Build order options list
        $order_by_options = ['Ascendente', 'Discendente']; 
        $order_by_options_html = '';
        foreach ($order_by_options as $option) {
            $order_by_options_html .= "<option value=\"$option\"";
            
            if ($_GET['search_order_by_mode'] == $option) {
                $order_by_options_html .= "selected=\"selected\"";
            }

            $order_by_options_html .= ">$option</option>";
        }

        $values['ORDER_BY_OPTIONS'] = $order_by_options_html;

        $this->replaceValues($values);
        return $this;
    }
}