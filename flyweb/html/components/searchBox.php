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

    public function __construct() {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->render();
    }

    public function render(): string {
        foreach ($this->values as $key => $value) {
            $values[$key] = $_GET[$key] ? $_GET[$key] : '';
        }

        $this->replaceValues($values);
        return $this;
    }
        
}