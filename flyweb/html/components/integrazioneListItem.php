<?php

namespace html\components;

use html\components\baseComponent;
use model\Integrazione;

class IntegrazioneListItem extends baseComponent {

    const _templateName = 'adm_integrazione_list_item';
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
                'id' => $this->integrazione->id_integrazione,
                'nome' => $this->integrazione->nome,
                'descrizione' => $this->integrazione->descrizione,
                'prezzo' => $this->integrazione->prezzo,
                'durata' => $this->integrazione->durata,
                'modifica' => ($_COOKIE['flw_user'] == 'admin') ? '
                <form action="./adm_integrazione_modifica.php" method="get" class="adm-form-card">
                    <input type="hidden" name="par_id" id="par_id" value="'.$id.'"> 
                    <input type="submit" class="adm-bottone-modifica-card" name="modifica"  value="MODIFICA"></button>
                </form>'.'
                <form action="./adm_landing_integrazione_eliminazione.php" method="get" class="adm-form-card" onsubmit="return confermaEliminazione()">
                    <input type="hidden" name="par_id" id="par_id" value="'.$id.'"> 
                    <input type="submit" class="adm-bottone-elimina-card" name="modifica" value="ELIMINA"></button>
                </form>':' '
            ]
         );
        return $this;
    }
        
}