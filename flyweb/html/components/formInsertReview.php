<?php

namespace html\components;

use \html\components\BaseComponent;
use \controllers\TravelController;
use controllers\RouteController;
class FormInsertReview extends BaseComponent {

    const _templateName = 'form_insert_review';
    private $id_viaggio;
    private $id_utente;

    public function __construct(int $id_viaggio,int $id_utente) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->id_viaggio=$id_viaggio;
        $this->id_utente=$id_utente;
        $this->render();
    }

    public function render(): string{

        $this->replaceValue('BASE', RouteController::BASE_ROUTE);
        $this->replaceValue('BASE_ADMIN', RouteController::ADMIN_BASE_ROUTE);
        $this->replaceValue("TITOLO_VIAGGIO",(new TravelController($this->id_viaggio))->getTitle($this->id_viaggio));
        $this->replaceValue("TYPE","inserimentoRecensioneUser");
        $this->replaceValue("ID_UTENTE",$this->id_utente);
        $this->replaceValue("ID_VIAGGIO",$this->id_viaggio);

        return $this;
    }
}