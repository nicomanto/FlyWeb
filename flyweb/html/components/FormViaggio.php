<?php

namespace html\components;

use \html\components\BaseComponent;
use model\Travel;
use \controllers\AdmController;

class FormViaggio extends baseComponent
{

    public $travel_loc;
    public $travel_tag;

    public $AdmController;

    const _templateName = 'adm_form_inserimento_viaggio';

    public function __construct($travel = null,$tag=null)
    {

        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->travel_loc = $travel;
        $this->travel_tag=$tag;
        $this->AdmController=(new AdmController());
        $this->render();
    }


    public function render(): string
    {
        //echo "debug";

        $this->replaceValues([
            'type' => (empty($this->travel_loc)) ? 'INSERISCI' : 'MODIFICA',
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

        $tagList=$this->AdmController->getTags();

        $checkBox="";
        foreach($tagList as $i){
            if(!empty($this->travel_tag) && in_array($i['ID_Tag'],$this->travel_tag))
                $checkBox.=new CheckBoxItem("Tag".$i['ID_Tag'],'tag[]',$i['ID_Tag'],"#".$i['Nome'],true);
            else
                $checkBox.=new CheckBoxItem("Tag".$i['ID_Tag'],'tag[]',$i['ID_Tag'],"#".$i['Nome']);
        }

        $this->replaceTag('CHECKBOX_TAG',$checkBox);

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
            'tag' => isset($_POST['tag']) ? $_POST['tag'] : array(),
            'integrazioni' => $_POST['integrazioni']
        ];

        return $dati;
    }
}
