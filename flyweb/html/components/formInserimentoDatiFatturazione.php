<?php

namespace html\components;

use \html\components\baseComponent;
use model\Order;

class FormInserimentoDatiFatturazione extends baseComponent {

    const _templateName = 'form_inserimento_dati_fatturazione';
    public $order;
    public $data_type;

    public function __construct(array $order=null) {

        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->order = $order;
        $this->data_type=$data_type;
        $this->render();
    }
    

    public function render(): string {
        //echo "debug";
           // $values = ['via','comune','cap','provincia'];

            $this->replaceValues([
                    'via' => (empty($this->order))?' ':$this->order['via'],
                    'comune' => (empty($this->order))?' ':$this->order['comune'],
                    'cap' => (empty($this->order))?' ':$this->order['cap'],
                    'provincia' => (empty($this->order))?' ':$this->order['provincia'],
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
