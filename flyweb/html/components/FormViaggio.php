<?php

namespace html\components;

use \html\components\baseComponent;
use model\Travel;

class FormViaggio extends baseComponent {

    public $travel_loc;

    const _templateName = 'adm_form_inserimento_viaggio';

    public function __construct($travel=null) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->travel_loc = $travel;
        $this->render();
    }

    public function render(): string {
        //echo "debug";
            // Eventually load login values from previous request
            $values = ['titolo','descrizione','descrizionebreve','stato','citta','localita','datainizio','datafine','prezzo'];


            if(! empty($travel_loc)){               //se è stato passato come parametro un oggetto riempie il form con i valori del Viaggio passato come parametro
                $this->replaceValuesInTemplate([
                        'titolo' => $_POST['titolo'],
                        'descrizione' => $_POST['descrizione'],
                        'descrizionebreve' => $_POST['descrizionebreve'],
                        'stato' => $_POST['stato'],
                        'citta' => $_POST['citta'],
                        'localita' => $_POST['localita'],
                        'datainizio' => $_POST['datainizio'],
                        'datafine' => $_POST['datafine'],
                        'prezzo' => $_POST['prezzo']
                ]);
            }else{                                  //altrimenti no
                $values = $this->loadValuesFromRequest($values);    //serve per POST in caso di modifica
                $this->replaceValuesInTemplate($values);
            }
            return $this;
    }

    //estrae i dati inseriti nel form e li mette in un array associativo
    public function estraiDatiViaggioDaForm(): array{ 
        $dati = [
            'titolo' => $_POST['titolo'],
            'descrizione' => $_POST['descrizione'],
            'descrizionebreve' => $_POST['descrizionebreve'],
            'stato' => $_POST['stato'],
            'citta' => $_POST['citta'],
            'localita' => $_POST['localita'],
            'datainizio' => $_POST['datainizio'],
            'datafine' => $_POST['datafine'],
            'prezzo' => $_POST['prezzo']
        ];
        
        return $dati;
    }
}
