<?php

namespace html;

require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');


class Template {

    public $_templateName;
    public $_template;

    // Constructor
    public function __construct(string $templateName) {
        $this->_templateName = $templateName;
        $this->load();
    }

    /**
     * Load `$this->templateName` template from 'hmtl' folder and 
     * return the loaded template
     *
     * @return string
     */
    public function load(): void {
        $filename = $_SERVER['DOCUMENT_ROOT'] . 'html/' . $this->_templateName . '.html';
        if (file_exists($filename)) {
            $this->_template = file_get_contents($filename);
        }
    }

    /**
     * Replaces tags `$tag` in `$this->_template` with `$content` 
     * and returns new `$this->template`
     *
     * @param string $tag
     * @param string $content
     * @return string
     */
    public function replaceTag(string $tag, string $content): string {
        $this->_template = str_replace('<' . $tag . '/>', $content, $this->_template);
        return $this->_template;
    }

    /**
     * Replaces tags `$value` in `$this->_template` with `$content` 
     * and returns new `$this->template`
     *
     * @param string $value
     * @param string $content
     * @return string
     */
    public function replaceValue(string $value, string $content): string {
        $this->_template = str_replace('%' . $value . '%', $content, $this->_template);
        return $this->_template;
    }


    /**
     * Reset template to it's original 
     *
     * @return string
     */
    public function reset(): string {
        return $this->load();
    }

    public function render(): string {
        return $this->_template;
    }


    /**
     * Magic method that handles object cast to string (in this way 
     * echoing a Template object will echo the rendered template)
     *
     * @return string
     */
    public function __toString(): string {
        return $this->_template;
    }
}
