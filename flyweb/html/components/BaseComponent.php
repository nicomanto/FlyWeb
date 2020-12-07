<?php
namespace html\components;

use html\template;
use controllers\RouteController;

class BaseComponent extends Template {
    
    // Constructor
    public function __construct(string $templateName) {
        parent::__construct($templateName);
    }

    /**
     * Load `$this->templateName` template from 'hmtl' folder and 
     * return the loaded template
     *
     * @return string
     */
    public function load(): void {
        
        $filename = $_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/html/components/html/' . $this->_templateName . '.html';
        if (file_exists($filename)) {
            $this->_template = file_get_contents($filename);
        }
    }

    /**
     * Checks if params are provided in the request, if yes, return them
     *
     * @return string
     */
    public function loadValuesFromRequest(array $params): array {
        $values = [];
        foreach ($params as $param) {
            if (isset($_POST[$param])) {
                $values[$param] = $_POST[$param];
            } else {
                $values[$param] = '';
            }
        }        

        return $values;
    }


    /**
     * Checks if params are provided in a cookie, if yes, return them
     *
     * @return string
     */
    public function loadValuesFromCookie(array $params): array {
        $values = [];
        foreach ($params as $param) {
            if (isset($_COOKIE[$param])) {
                $values[$param] = $_COOKIE[$param];
            } else {
                $values[$param] = '';
            }
        }        

        return $values;
    }    

    public function render(): string {

        $this->replaceValue('BASE', RouteController::BASE_ROUTE);
        $this->replaceValue('BASE_ADMIN', RouteController::ADMIN_BASE_ROUTE);
        return $this;
    }
}