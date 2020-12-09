<?php

namespace html\components;

use html\components\baseComponent;
use html\components\pageSelectorItem;

class PageSelector extends baseComponent {


    public $currentPage;
    public $totalPages;

    const _templateName = 'page_selector';

    public function __construct(array $paginatedList) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->currentPage = $paginatedList['currentPage'];
        $this->totalPages = $paginatedList['totalPages'];
        $this->render();
    }

    public function render(): string {
        $pages_list = '';
        $end_counter = $this->currentPage + 1;
        $start_counter = $this->currentPage - 1;
        $show_first = $this->currentPage != 1;
        $show_last = $this->currentPage != $this->totalPages;

        // print_r($this->currentPage);
        // print_r(', ');
        // print_r($this->totalPages);
        // print_r(', ');
        // print_r($show_first);
        // print_r(', ');
        // print_r($show_last);


        // If there is only one page 
        if ($this->totalPages == 1) {
            $show_first = false;
            $show_last = false;
            $start_counter = 1;
            $end_counter = 1;
        }

        // If there are two pages
        if ($this->totalPages == 2) {
            $show_first = false;
            $show_last = false;
            $start_counter = 1;
            $end_counter = 2;
        }

        // If current page is the first or the second
        if ($this->currentPage == 2 || $this->currentPage == 1) {
            $show_first = false;
            $start_counter = 1;
        }

        // If current page is the penultimate or the ultimate
        if ($this->currentPage == $this->totalPages - 1 || $this->currentPage == $this->totalPages) {
            $show_last = false;
            $end_counter = $this->totalPages;
        }

        // If current page is the last
        if ($this->currentPage == $this->totalPages) {

        }

        // Anchor for first page
        if ($show_first) {
            $pages_list = $pages_list . new PageSelectorItem(1, false) . '<span>&nbsp;...&nbsp;<spanp>';
        }

        for ($i = $start_counter; $i <= $end_counter; $i++) {
            $pages_list .= new PageSelectorItem($i, ($i == $this->currentPage));
        }

        // Anchor for last page
        if ($show_last) {
            $pages_list = $pages_list . '<spanp>&nbsp;...&nbsp;</span>' . new PageSelectorItem($this->totalPages, false);
        }
        
        // Replace value in template with generated html
        $this->replaceTag('PAGES_LIST', $pages_list);

        return $this;
    }
}