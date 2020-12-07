<?php

namespace html\components;

use html\components\baseComponent;
use controllers\RouteController;

class PageSelectorItem extends baseComponent {

    public $pageNumber;
    public $isCurrentPage;

    const _templateName = 'page_selector_item';

    public function __construct(int $pageNumber, bool $isCurrentPage) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->pageNumber = $pageNumber;
        $this->isCurrentPage = $isCurrentPage;
        $this->render();
    }

    public function render(): string {

        $this->replaceValue('BASE', RouteController::BASE_ROUTE);
        $this->replaceValue('BASE_ADMIN', RouteController::ADMIN_BASE_ROUTE);
        
        // Select class based on if the page is the current page or not
        if ($this->isCurrentPage) {
            $class = 'active';
            $url = '';
        } else {
            $class = '';
            $url = $this->buildPageUrl($this->pageNumber);
        }
        

        $this->replaceValues([
            'PAGE_NUMBER' => $this->pageNumber,
            'IS_PAGE_SELECTED' => $class,
            'PAGE_URL' => $url
        ]);

        return $this;
    }

    private function buildPageUrl(): string {
        $_GET['page'] = $this->pageNumber;
        return $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
    }
}