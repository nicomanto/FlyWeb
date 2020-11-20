<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $page = new \html\template('board');

    $admController = new \controllers\AdmController();
    $form = new \html\components\FormViaggio();
    $viaggio = $form->estraiDatiViaggio();

    $str=" ";


    if(($viaggio['id'] == ' ')){        //se non c'è parametro id allora viaggio dev'essere inserito ex novo
        $str= "inserimento";
        $admController->inserisciViaggio($viaggio);
        $v_id=$admController->getTravelIdByTitle($viaggio['titolo']);
        $admController->setTagViaggio($v_id,$viaggio['tag']);
    }else{
        $str= "aggiornamento";
        $admController->resetTagViaggio($viaggio['id']);
        $admController->aggiornaViaggio($viaggio);
        $admController->setTagViaggio($viaggio['id'],$viaggio['tag']);
    }



    //in ogni caso devo ri-settare i tag

    //e le foto... to-do


    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-FORM-INSERIMENTO-VIAGGIO', '');

    $t = $viaggio['titolo'];

    $page->replaceTag('ADM-SUCCESSO', (new \html\components\AdmSuccesso($t,$str)));
    $page->replaceTag('ADM-DASHBOARD', '');
    $page->replaceTag('ADM-REVIEWS', '');


    echo $page;


