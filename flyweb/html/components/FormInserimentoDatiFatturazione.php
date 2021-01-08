<?php

namespace html\components;

use \html\components\baseComponent;
use model\Order;

class FormInserimentoDatiFatturazione extends baseComponent {

    const _templateName = 'form_inserimento_dati_fatturazione';
    public $order;

    public function __construct() {

        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->order = $order;
        $this->render();
    }
    

    public function render(): string {
        //echo "debug";
            $values = ['via','comune','cap','provincia'];

            $this->replaceValues([
                    'via' => $this->order->via,
                    'comune' => $this->order->comune,
                    'cap' => $this->order->cap,
                    'provincia' => $this->order->provincia,
                    'metodopagamento' => $_POST['metodopagamento']

            ]);
            
            return $this;
    }

    //estrae i dati inseriti nel form e li mette in un array associativo
    public function estraiDatiFatturazione(): array{ 

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