<?php

namespace html\components;

use html\components\baseComponent;
use model\Travel;
use controllers\RouteController;

class AdmTravelListItem extends baseComponent {

    const _templateName = 'adm_travel_list_item';
    public $travel;

    public function __construct(array $travel) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);

        // Unpacking associative array (from db) into Travel
        $this->travel = new Travel($travel);

        // Render page
        $this->render();
    }

    public function render(): string {

        $this->replaceValue('BASE', RouteController::BASE_ROUTE);
        $this->replaceValue('BASE_ADMIN', RouteController::ADMIN_BASE_ROUTE);

        $st = $this->travel->id_viaggio;

        $this->replaceValues([
                'id' => $this->travel->id_viaggio,
                'travel_title' => $this->travel->titolo,
                'travel_description' => $this->travel->descrizioneBreve,
                'travel_price' => $this->travel->prezzo,
                'travel_start_date' => $this->travel->data_inizio,
                'travel_end_date' => $this->travel->data_fine,
                'travel_country' => $this->travel->stato,
                'travel_city' => $this->travel->city,
                'travel_location' => $this->travel->location,
                'st' => $st
            ]);
        return $this;
    }       
}