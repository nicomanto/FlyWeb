<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $page = new \html\template('board');

    $form = new \html\components\AdmFormIntegrazione();
    $integrazione = $form->estraiDatiIntegrazione();
    //print_r($integrazione);
    $integrazioneController = new \controllers\IntegrazioneController();

    $str=" ";


    if(($integrazione['id_integrazione'] == ' ')){        //se non c'è parametro id allora viaggio dev'essere inserito ex novo
        $str= "inserimento";
        //echo "sksk";
        $integrazioneController->inserisciIntegrazione($integrazione);
    }else{
        $str= "aggiornamento";
        $integrazioneController->aggiornaIntegrazione($integrazione);
    }


    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-FORM-INSERIMENTO-VIAGGIO', '');

    $t = $integrazione['nome'];

    $page->replaceTag('ADM-SUCCESSO', (new \html\components\AdmSuccesso($t,$str)));
    $page->replaceTag('ADM-DASHBOARD', '');
    $page->replaceTag('ADM-REVIEWS', '');
    $page->replaceTag('ADM-FORM-INSERIMENTO-INTEGRAZIONE', '');

    echo $page;