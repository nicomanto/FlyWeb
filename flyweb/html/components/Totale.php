<?php

namespace html\components;

use html\components\baseComponent;

class Totale extends baseComponent {
    
    const _templateName = 'totale';
    private $tot;

    public function __construct($tot) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->tot=$tot;
        $this->render();
    }

    public function render(): string{
        $this->replaceValue("TOT",$this->tot);
        return $this;
   }


   public function estraiDatiOrdine(): array{ 

    $dati = [
        'via' => $_POST['via'],
        'comune' => $_POST['comune'],
        'cap' => $_POST['cap'],
        'provincia' => $_POST['provincia'],
        'metodopagamento' => $_POST['metodopagamento']
    ];
    
    return $dati;
}
        
}