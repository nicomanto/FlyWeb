<?php

namespace html\components;

use \html\components\BaseComponent;
use controllers\AdmController;
use controllers\ImagesController;

class FormViaggio extends baseComponent
{

    private $error;

    public $travel_loc;
    public $travel_tag;

    public $image_required;

    public $AdmController;

    const _templateName = 'adm_form_inserimento_viaggio';

    public function __construct(array $error, $travel = null,$tag=null, bool $image_required=true)
    {

        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->travel_loc = $travel;
        $this->travel_tag=$tag;
        $this->error=$error;
        $this->image_required = $image_required;
        $this->AdmController=(new AdmController());
        $this->render();
    }


    public function render(): string
    {
        $imagesController = new ImagesController();
        //echo "debug";
        
        $timestamp = strtotime(str_replace('/', '-', $this->travel_loc->data_inizio));
        $data_inizio = date("Y-m-d", $timestamp);

        $timestamp = strtotime(str_replace('/', '-', $this->travel_loc->data_fine));
        $data_fine = date("Y-m-d", $timestamp);

        //print_r($this->travel_loc);
        $this->replaceValues([
            'type' => (empty($this->travel_loc->id_viaggio)) ? 'INSERISCI' : 'MODIFICA',
            'link_action' => (empty($this->travel_loc->id_viaggio)) ? './adm_form_inserimento.php' : './adm_form_modifica.php',
            'titolo' => (empty($this->travel_loc)) ? '' : $this->travel_loc->titolo,
            'descrizione' => (empty($this->travel_loc)) ? '' : $this->travel_loc->descrizione,
            'descrizioneBreve' => (empty($this->travel_loc)) ? '' : $this->travel_loc->descrizioneBreve,
            'stato' => (empty($this->travel_loc)) ? '' : $this->travel_loc->stato,
            'citta' => (empty($this->travel_loc)) ? '' : $this->travel_loc->citta,
            'localita' => (empty($this->travel_loc)) ? '' : $this->travel_loc->localita,
            'datainizio' => (empty($this->travel_loc)) ? '' : $data_inizio,
            'datafine' => (empty($this->travel_loc)) ? '' : $data_fine,
            'prezzo' => (empty($this->travel_loc) || $this->travel_loc->prezzo==0) ? '' : $this->travel_loc->prezzo,
            'altImmagine' => (empty($this->travel_loc)) ? '' : $this->travel_loc->altImmagine,
            'id' => (empty($this->travel_loc)) ? '' : $this->travel_loc->id_viaggio,  
            'image_required' => $this->image_required ? 'required="required"' : ''
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

        if(!empty($this->travel_loc) && !empty( $this->travel_loc->immagine)){
            $this->replaceTag('IMAGE_INSERT_TRAVEL','
            <div><img class="main-img" 
            src="'. $imagesController->getImagePath( $this->travel_loc->immagine) .'" alt="' . $this->travel_loc->altImmagine . '"/></div>');
        }
        else{
            $this->replaceTag('IMAGE_INSERT_TRAVEL','');
        }
        

        if(!empty($this->error)){

            $this->replaceTag('ERROR_BOX',new ErrorBox($this->error));
        }
        else{
            $this->replaceTag('ERROR_BOX','');
        }

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
            //'integrazioni' => $_POST['integrazioni'],
            'altImmagine' => $_POST['altImmagine']
        ];

        return $dati;
    }
}
