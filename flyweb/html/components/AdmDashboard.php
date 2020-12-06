<?php

namespace html\components;

use \html\components\BaseComponent;

use \html\components\AdmMenuComponent;

class AdmDashBoard extends BaseComponent {

    const _templateName = "adm_dashboard";

    private $menu =
    [   'generale'              => '<a href="/adm_form_inserimento.php"><li class="menu_dash_element">INSERISCI VIAGGIO</li></a><a href="/adm_search.php"><li class="menu_dash_element">GESTISCI VIAGGI</li></a><a href="/adm_integrazione_inserimento.php"><li class="menu_dash_element">INSERISCI INTEGRAZIONI</li></a><a href="/adm_integrazioni.php"><li class="menu_dash_element">GESTISCI INTEGRAZIONI</li></a><a href="/adm_moderazione_recensioni.php"><li class="menu_dash_element">MODERA RECENSIONI</li></a><a href="/index.php" onclick="admlogout()"><li class="menu_dash_element">LOGOUT</li></a>',
        'inserisci_viaggio'     => '<li class="menu_dash_element_selected">INSERISCI VIAGGIO</li> <a href="/adm_search.php"><li class="menu_dash_element">GESTISCI VIAGGI</li>        </a>        <a href="/adm_integrazione_inserimento.php">            <li class="menu_dash_element">                INSERISCI INTEGRAZIONI            </li>        </a>        <a href="/adm_integrazioni.php">            <li class="menu_dash_element">                GESTISCI INTEGRAZIONI            </li>        </a>        <a href="/adm_moderazione_recensioni.php">            <li class="menu_dash_element">                MODERA RECENSIONI            </li>        </a>        <a href="/index.php" onclick="admlogout()">            <li class="menu_dash_element">                LOGOUT            </li>        </a>',
        'gestisci_viaggi'       => '<a href="/adm_form_inserimento.php"><li class="menu_dash_element">INSERISCI VIAGGIO</li></a><a><li class="menu_dash_element_selected">GESTISCI VIAGGI            </li>        </a>        <a href="/adm_integrazione_inserimento.php">            <li class="menu_dash_element">                INSERISCI INTEGRAZIONI            </li>        </a>        <a href="/adm_integrazioni.php">            <li class="menu_dash_element">                GESTISCI INTEGRAZIONI            </li>        </a>        <a href="/adm_moderazione_recensioni.php">            <li class="menu_dash_element">                MODERA RECENSIONI            </li>        </a>                  <a href="/index.php" onclick="admlogout()">            <li class="menu_dash_element">LOGOUT</li>        </a>',
        'inserisci_integrazione'=> '<a href="/adm_form_inserimento.php"><li class="menu_dash_element">INSERISCI VIAGGIO</li></a><a href="/adm_search.php"><li class="menu_dash_element">                GESTISCI VIAGGI            </li>        </a>        <a>            <li class="menu_dash_element_selected">                INSERISCI INTEGRAZIONI            </li>        </a>        <a href="/adm_integrazioni.php">            <li class="menu_dash_element">                GESTISCI INTEGRAZIONI            </li>        </a>        <a href="/adm_moderazione_recensioni.php">            <li class="menu_dash_element">                MODERA RECENSIONI            </li>        </a>            <a href="/index.php" onclick="admlogout()">            <li class="menu_dash_element">LOGOUT</li>        </a>', 
        'gestisci_integrazioni' => '<a href="/adm_form_inserimento.php"><li class="menu_dash_element">INSERISCI VIAGGIO</li></a><a href="/adm_search.php"><li class="menu_dash_element">GESTISCI VIAGGI</li></a><a href="/adm_integrazione_inserimento.php"><li class="menu_dash_element">INSERISCI INTEGRAZIONI</li></a><a><li class="menu_dash_element_selected">GESTISCI INTEGRAZIONI</li></a><a href="/adm_moderazione_recensioni.php"><li class="menu_dash_element">MODERA RECENSIONI</li></a><a href="/index.php" onclick="admlogout()"><li class="menu_dash_element">LOGOUT</li></a>',
        'modera_recensioni'     => '<a href="/adm_form_inserimento.php"><li class="menu_dash_element">INSERISCI VIAGGIO</li></a><a href="/adm_search.php"><li class="menu_dash_element">                GESTISCI VIAGGI            </li>        </a>        <a href="/adm_integrazione_inserimento.php">            <li class="menu_dash_element">                INSERISCI INTEGRAZIONI            </li>        </a>        <a href="/adm_integrazioni.php">            <li class="menu_dash_element">                GESTISCI INTEGRAZIONI            </li>        </a>        <a>            <li class="menu_dash_element_selected">                MODERA RECENSIONI            </li>        </a>               <a href="/index.php" onclick="admlogout()">            <li class="menu_dash_element">LOGOUT</li>        </a>'
    ];
    private $tipo;

    public function __construct($tipo=null) {
        // Call BaseComponent constructor
        parent::__construct(self::_templateName);
        $this->render();
    }

    public function render(): string{

        $this->replaceTag('MENUADM', new \html\components\AdmMenuComponent());

        return $this;
    }
}