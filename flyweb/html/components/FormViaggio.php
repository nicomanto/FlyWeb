<?php

namespace html\components;

use \html\components\BaseComponent;
use model\Travel;

class FormViaggio extends baseComponent
{

    public $travel_loc;

    const _templateName = 'adm_form_inserimento_viaggio';

    public function __construct($travel = null)
    {

        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->travel_loc = $travel;
        $this->render();
    }


    public function render(): string
    {
        //echo "debug";

        $this->replaceValues([
            'titolo' => (empty($this->travel_loc)) ? '' : $this->travel_loc->titolo,
            'descrizione' => (empty($this->travel_loc)) ? '' : $this->travel_loc->descrizione,
            'descrizioneBreve' => (empty($this->travel_loc)) ? '' : $this->travel_loc->descrizioneBreve,
            'stato' => (empty($this->travel_loc)) ? '' : $this->travel_loc->stato,
            'citta' => (empty($this->travel_loc)) ? '' : $this->travel_loc->citta,
            'localita' => (empty($this->travel_loc)) ? '' : $this->travel_loc->localita,
            'datainizio' => (empty($this->travel_loc)) ? '' : $this->travel_loc->data_inizio,
            'datafine' => (empty($this->travel_loc)) ? '' : $this->travel_loc->data_fine,
            'prezzo' => (empty($this->travel_loc)) ? '' : $this->travel_loc->prezzo,
            'id' => (empty($this->travel_loc)) ? '' : $this->travel_loc->id_viaggio
        ]);

        return $this;
    }

    //estrae i dati inseriti nel form e li mette in un array associativo
    public function estraiDatiViaggio(): array
    {

        $dati = [
            'titolo' => $_POST['titolo'],
            'descrizione' => $_POST['descrizione'],
            'descrizioneBreve' => $_POST['descrizionebreve'],
            'stato' => $_POST['stato'],
            'citta' => $_POST['citta'],
            'localita' => $_POST['localita'],
            'datainizio' => $_POST['datainizio'],
            'datafine' => $_POST['datafine'],
            'prezzo' => $_POST['prezzo'],
            'id' => $_POST['id'],
            'tag' => $_POST['tagDaInviare'],
            'integrazioni' => $_POST['integrazioni']
        ];

        return $dati;
    }
}
