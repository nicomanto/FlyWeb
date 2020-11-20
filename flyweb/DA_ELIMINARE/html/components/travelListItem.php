<?php

namespace html\components;

use html\components\baseComponent;
use model\Travel;

class TravelListItem extends baseComponent {

    const _templateName = 'travel_list_item';
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

        //echo "!!!". $this->travel->titolo;

        $continueReading = '... <a href=travel?id=' . $this->travel->id_viaggio . '>continua a leggere</a>';

        // Load travel properties into template
        $titolo = strlen($this->travel->titolo) > 30 ? substr($this->travel->titolo, 0, 30) . '...' : $this->travel->titolo;
        $descrizione = strlen($this->travel->descrizione) > 200 ? substr($this->travel->descrizione, 0, 200) . $continueReading : $this->travel->descrizione;
        $st = $this->travel->id_viaggio;

        $this->replaceValues([
                'travel_id' => $this->travel->id_viaggio,
                'travel_title' => $this->travel->titolo,
                'travel_description' => $this->travel->descrizione,
                'travel_price' => $this->travel->prezzo,
                'travel_start_date' => $this->travel->data_inizio,
                'travel_end_date' => $this->travel->data_fine,
                'travel_country' => $this->travel->stato,
                'travel_city' => $this->travel->city,
                'travel_location' => $this->travel->location,
                'modifica' => ($_COOKIE['flw_user'] == 'admin') ? '
                <form action="./adm_form_modifica.php" method="get">
                    <input type="hidden" name="par_id" id="par_id" value="'.$st.'"> 
                    <input type="submit" name="modifica" id="modifca" value="MODIFICA"></button>
                </form>'.'
                <form action="./adm_landing_form_eliminazione.php" method="get">
                    <input type="hidden" name="par_id" id="par_id" value="'.$st.'"> 
                    <input type="submit" name="modifica" id="modifca" value="ELIMINA"></button>
                </form>':' '
            ]
         );
        return $this;
    }
        
}