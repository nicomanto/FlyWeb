<?php

namespace html\components;

use html\components\baseComponent;
use model\Integrazione;

class IntegrazioneListItem extends baseComponent {

    const _templateName = 'integrazione_list_item';
    public $integrazione;

    public function __construct(array $integrazione) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);

        // Unpacking associative array (from db) into Travel
        $this->integrazione = new Integrazione($integrazione);

        // Render page
        $this->render();
    }

    public function render(): string {

        // Load travel properties into template
        $id = $this->integrazione->id_integrazione;

        $this->replaceValues([
                'integrazione_id' => $this->integrazione->id_integrazione,
                'nome' => $this->integrazione->nome,
                'descrizione' => $this->integrazione->descrizione,
                'prezzo' => $this->integrazione->prezzo,
                'durata' => $this->integrazione->durata,
                'modifica' => ($_COOKIE['flw_user'] == 'admin') ? '
                <form action="./adm_integrazione_modifica.php" method="get">
                    <input type="hidden" name="par_id" id="par_id" value="'.$id.'"> 
                    <input type="submit" name="modifica" id="modifca" value="MODIFICA"></button>
                </form>'.'
                <form action="./adm_landing_integrazione_eliminazione.php" method="get">
                    <input type="hidden" name="par_id" id="par_id" value="'.$id.'"> 
                    <input type="submit" name="modifica" id="modifca" value="ELIMINA"></button>
                </form>':' '
            ]
         );
        return $this;
    }
        
}