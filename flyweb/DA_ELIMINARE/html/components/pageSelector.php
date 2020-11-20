<?php

namespace html\components;

use html\components\baseComponent;
use html\components\pageSelectorItem;

class PageSelector extends baseComponent {


    public $currentPage;
    public $totalPages;

    const _templateName = 'page_selector';

    public function __construct(int $currentPage, int $totalPages) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->currentPage = $currentPage;
        $this->totalPages = $totalPages;
        $this->render();
    }

    public function render(): string {
        $pages_list = '';

        for ($i = 1; $i <= $this->totalPages; $i++) {
            $pages_list .= new PageSelectorItem($i, ($i == $this->currentPage));
        }
        
        // Replace value in template with generated html
        $this->replaceTag('PAGES_LIST', $pages_list);

        return $this;
    }
}