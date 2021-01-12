<?php

use controllers\IntegrazioneController;
use controllers\RouteController;
use html\components\AdmDashBoard;
use html\components\AdmFormIntegrazione;
use html\components\AdmSuccesso;
use html\components\Head;
use html\Template;

require_once('../autoload.php');

    RouteController::protectedRoute();

    $page = new Template('board');

    $form = new AdmFormIntegrazione();
    $integrazione = $form->estraiDatiIntegrazione();
    //print_r($integrazione);
    $integrazioneController = new IntegrazioneController();

    $str=" ";


    if(($integrazione['id_integrazione'] == '')){        //se non c'è parametro id allora viaggio dev'essere inserito ex novo
        $str= "inserimento";
        //echo "sksk";
        $integrazioneController->inserisciIntegrazione($integrazione);
    }else{
        $str= "aggiornamento";
        $integrazioneController->aggiornaIntegrazione($integrazione);
    }

    $t = $integrazione['nome'];

    $page->replaceTag('HEAD', (new Head));

    $page->replaceTag('ADM-MENU', (new AdmDashboard("generale")));

    $page->replaceTag('ADM-CONTENUTO', (new AdmSuccesso($t,$str)));

    echo $page;