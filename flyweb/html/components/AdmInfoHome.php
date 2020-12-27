<?php

namespace html\components;

use controllers\UserController;
use controllers\ReviewController;
use model\User;

class AdmInfoHome extends baseComponent
{

    const _templateName = 'adm_info_home';
    private $Admin;

    public function __construct()
    {

        // Call BaseComponent constructor
        parent::__construct(self::_templateName);

        $this->Admin=(new UserController())->user;
        $this->render();
    }


    public function render(): string
    {
        
        //echo "debug";
        $this->replaceValues([
            'NOME' => $this->Admin->nome,
            'COGNOME' => $this->Admin->cognome,
            'HAVE_RECENSIONI' => (new ReviewController())->getNumberNoModReview()
        ]);
        return $this;
    }
}
