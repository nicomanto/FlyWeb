<?php

namespace html\components;

use html\components\baseComponent;
use model\User;

class DatiPersonali extends baseComponent {

    const _templateName = 'datipersonali';
    public $user;

    public function __construct($user) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->user = $user;
        $this->render();
    }

    public function render(): string {
        $this->replaceValues([
            'username' => $this->user->username,
            'email' => $this->user->email,
            'password' => $this->user->password,
            'nome' => $this->user->nome,
            'cognome' => $this->user->cognome,
            'data_nascita' => $this->user->data_nascita
        ]);
        return $this;
    }   
}