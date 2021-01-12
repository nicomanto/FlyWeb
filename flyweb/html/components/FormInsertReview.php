<?php

namespace html\components;

use \html\components\BaseComponent;

use TravelController;

class FormInsertReview extends BaseComponent {

    const _templateName = 'form_insert_review';
    private $error;
    private $id_viaggio;
    private $id_utente;

    public function __construct(array $error, int $id_viaggio) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->error=$error;
        $this->id_viaggio=$id_viaggio;
        $this->id_utente=$id_utente;
        $this->render();
    }

    public function render(): string{

        $signupValuesKeys = ['titolo', 'descrizione', 'valutazione'];
        $signupValues = $this->loadValuesFromRequest($signupValuesKeys);
        $this->replaceValues($signupValues);

        if(!empty($this->error)){

            $this->replaceTag('ERROR_BOX',new ErrorBox($this->error));
        }
        else{
            $this->replaceTag('ERROR_BOX','');
        }

        $this->replaceValue("TITOLO_VIAGGIO",(new TravelController($this->id_viaggio))->getTitle($this->id_viaggio));
        $this->replaceValue("ID_VIAGGIO",$this->id_viaggio);

        return $this;
    }
}