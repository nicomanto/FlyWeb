<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $page = new \html\template('board');

    $admController = new \controllers\AdmController();
    $form = new \html\components\FormViaggio();
    $viaggio = $form->estraiDatiViaggio();

    //print_r($viaggio);

    $str=" ";


    if(($viaggio['id'] == ' ')){        //se non c'è parametro id allora viaggio dev'essere inserito ex novo
        $str= "inserimento";
        $admController->inserisciViaggio($viaggio);
    }else{
        $str= "aggiornamento";
        $admController->aggiornaViaggio($viaggio);
    }



    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-FORM-INSERIMENTO-VIAGGIO', '');

    $t = $viaggio['titolo'];

    $page->replaceTag('ADM-SUCCESSO', (new \html\components\AdmSuccesso($t,$str)));

    echo $page;


