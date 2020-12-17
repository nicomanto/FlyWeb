<?php

namespace html\components;

use html\components\baseComponent;
use controllers\SearchController;
use model\Review;

class AdmContainerList extends baseComponent {

    const _templateName = 'adm_container_list';
    private $paginatedElements;
    private $title;

    public function __construct($paginatedElements,$title) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);

        // Unpacking associative array (from db) into Travel

        $this->paginatedElements=$paginatedElements;
        $this->title=$title;

        // Render page
        $this->render();
    }

    public function render(): string {

        $searchResults="";

        

        if($this->title=="LISTA VIAGGI"){
            $this->replaceTag('SEARCH_BOX', (new \html\components\searchBox()));
            foreach ($this->paginatedElements['elements'] as $element) {
                $searchResults.= new \html\components\AdmTravelListItem($element);
            }
        }
        else{
            $this->replaceTag('SEARCH_BOX', "");
            foreach ($this->paginatedElements['elements'] as $element) {
                $searchResults.= (new \html\components\AdmTravelReviewItem((new \model\Review($element))));
            }
        }
        

        $this->replaceValue('LIST_TITLE', $this->title);

        $this->replaceTag('LIST_ITEM', $searchResults);

        $this->replaceTag('PAGE-SELECTOR', (new \html\components\pageSelector($this->paginatedElements)));
        return $this;
    }       
}