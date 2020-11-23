<?php

namespace html\components;

use \html\components\BaseComponent;
use model\Integrazione;

class AdmFormIntegrazione extends baseComponent
{

    public $integrazione_loc;

    const _templateName = 'adm_form_integrazione';

    public function __construct($integrazione= null)
    {

        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->integrazione_loc = $integrazione;
        $this->render();
    }


    public function render(): string
    {
        //echo "debug";
        $this->replaceValues([
            'titolo' => (empty($this->integrazione_loc)) ? ' ' : $this->integrazione_loc->nome,
            'descrizione' => (empty($this->integrazione_loc)) ? ' ' : $this->integrazione_loc->descrizione,
            'durata' => (empty($this->integrazione_loc)) ? ' ' : $this->integrazione_loc->durata,
            'prezzo' => (empty($this->integrazione_loc)) ? ' ' : $this->integrazione_loc->prezzo,
            'id' => (empty($this->integrazione_loc)) ? ' ' : $this->integrazione_loc->id_integrazione
        ]);
        return $this;
    }

    //estrae i dati inseriti nel form e li mette in un array associativo
    public function estraiDatiIntegrazione(): array
    {
        $dati = [
            'nome' => $_POST['titolo_integrazione'],
            'descrizione' => $_POST['descrizione_integrazione'],
            'durata' => $_POST['durata_integrazione'],
            'prezzo' => $_POST['prezzo_integrazione'],
            'id' => $_POST['id_integrazione']
        ];

        return $dati;
    }
}
