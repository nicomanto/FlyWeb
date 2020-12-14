<?php

namespace html\components;

use \html\components\baseComponent;
use model\User;

class ModificaInfoProfilo extends baseComponent {

    const _templateName = 'form_modifica_profilo';
    public $user;

    public function __construct($user) {

        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->user = $user;
        $this->render();
    }
    

    public function render(): string {
        //echo "debug";
            $values = ['username','email','nome','cognome','data_nascita','password'];

            $this->replaceValues([
                    'username' => (empty($this->user))?' ':$this->user->username,
                    'email' => (empty($this->user))?' ':$this->user->email,
                    'nome' => (empty($this->user))?' ':$this->user->nome,
                    'cognome' => (empty($this->user))?' ':$this->user->cognome,
                    'data_nascita' => (empty($this->user))?' ':$this->user->data_nascita,
                    'password' => (empty($this->user))?' ':$this->user->password
            ]);
            
            return $this;
    }

    //estrae i dati inseriti nel form e li mette in un array associativo
    public function estraiDatiUtente(): array{ 

        $dati = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'nome' => $_POST['nome'],
            'cognome' => $_POST['cognome'],
            'data_nascita' => $_POST['data_nascita'],
            'password' => $_POST['password'],
        ];
        
        return $dati;
    }
}
