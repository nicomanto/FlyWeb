<?php

namespace html\components;

use \html\components\BaseComponent;


class Footer extends BaseComponent {

    const _templateName = "footer";

    public function __construct() {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->render();
    }

    public function render(): string{

        $this->replaceTag('FOOTERSITEMAP', new FooterSiteMap());

        return $this;
    }
}

?>