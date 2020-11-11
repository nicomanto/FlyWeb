<?php
namespace html\components;

use html\Template;

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
        
        $filename = $_SERVER['DOCUMENT_ROOT'] . 'html/components/html/' . $this->_templateName . '.html';
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

    /**
     * Replaces $valueName_VALUE in template with $values[$valueName]
     *
     * @param array $valuesNames
     * @param array $values
     * @return void
     */
    public function replaceValuesInTemplate(array $valuesNames, array $values) {
        if (count($valuesNames) != count($values)) {
            echo 'Qualcosa non tona...';
            exit();
        }
        
        foreach ($valuesNames as $valueName) {
            $key = strtoupper($valueName) . '_VALUE';
            $this->replaceValue($key , $values[$valueName]);            
        }
    }
}