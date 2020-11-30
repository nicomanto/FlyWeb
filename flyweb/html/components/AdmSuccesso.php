<?php

namespace html\components;

class AdmSuccesso extends BaseComponent {

    /*
        componente che visualizza l'andata a buon fine di un'operazione di gestione lato  amministratore
        __construct($titolo, $tipoOp):  titolo è il titolo del viaggio sul quale è effettuata l'operazione
                                        tipoOp è il tipo di operazione da passare come stringa " "
                                                serve solo da visualizzare non ha compiti logici
    */

    const _templateName = 'adm_successo';

    public $titoloViaggio;
    public $tipoOperazione;

    public function __construct($titolo, $tipoOp) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->titoloViaggio = $titolo;
        $this->tipoOperazione= $tipoOp;

        //echo $this->tipoOperazione. " - ". $this->titoloViaggio;
        $this->render();
    }

    public function render(): string {
        
        //echo $tipoOperazione. " - ". $titoloViaggio;

        $this->replaceValues([
            'op' => $this->tipoOperazione,
            'titolo' => $this->titoloViaggio
        ]);
        return $this;
    }

}
