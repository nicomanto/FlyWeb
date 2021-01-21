<?php

namespace html\components;

use html\components\baseComponent;

class PageSelectorItem extends baseComponent {

    public $pageNumber;
    public $isCurrentPage;
    public $url;

    const _templateName = 'page_selector_item';

    public function __construct(int $pageNumber, bool $isCurrentPage) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->pageNumber = $pageNumber;
        $this->isCurrentPage = $isCurrentPage;
        $this->render();
    }

    public function render(): string {
        // Select class based on if the page is the current page or not
        if ($this->isCurrentPage) {
            $element = "<span class=\"button-selector-page disabled\">$this->pageNumber</span>";
        } else {
            $this->url = $this->buildPageUrl($this->pageNumber);
            $element = "<a href=\"$this->url\" class=\"button-selector-page\">$this->pageNumber<\a>";
        }
        
        $this->replaceValue('ELEMENT', $element);
        return $this;
    }

    private function buildPageUrl(): string {
        $_GET['page'] = $this->pageNumber;
        return $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
    }
}