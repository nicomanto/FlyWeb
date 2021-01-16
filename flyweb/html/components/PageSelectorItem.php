<?php

namespace html\components;

use html\components\baseComponent;

class PageSelectorItem extends baseComponent {

    public $pageNumber;
    public $isCurrentPage;
    public $url;
    public $isDisabled;

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
            $this->url = '';
        } else {
            $this->isDisabled  = '';
            $this->url = $this->buildPageUrl($this->pageNumber);
        }
        

        $this->replaceValues([
            'PAGE_NUMBER' => $this->pageNumber,
            'PAGE_URL' => "href=".'"'.$this->url.'"'
        ]);
        return $this;
    }

    private function buildPageUrl(): string {
        $_GET['page'] = $this->pageNumber;
        return $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
    }
}