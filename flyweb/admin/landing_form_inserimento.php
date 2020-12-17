<?php
    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();

    $page = new \html\template('board');

    $admController = new \controllers\AdmController();
    $form = new \html\components\FormViaggio();
    $viaggio = $form->estraiDatiViaggio();

    $str="";

    //echo "!!!!!! ".$viaggio['id'];
    // print_r($viaggio['integrazioni']);

    if(($viaggio['id'] == '')){        //se non c'è parametro id allora viaggio dev'essere inserito ex novo
        $str= "inserimento";
        $admController->inserisciViaggio($viaggio);
        $v_id=$admController->getTravelIdByTitle($viaggio['titolo']);
        if(! empty($viaggio['tag'])){
            $admController->setTagViaggio($v_id,$viaggio['tag']);
        }
        $admController->setIntegrazioniViaggio($v_id,$viaggio['integrazioni']);

    }else{
        $str= "aggiornamento";
        $admController->resetTagViaggio($viaggio['id']);
        $admController->resetIntegrazioneViaggio($viaggio['id']);
        $admController->aggiornaViaggio($viaggio);
        if(! empty($viaggio['tag'])){
            $admController->setTagViaggio($viaggio['id'],$viaggio['tag']);
        }
        $admController->setIntegrazioniViaggio($viaggio['id'],$viaggio['integrazioni']);
    }



    //in ogni caso devo ri-settare i tag

    //e le foto... to-do

    $t = $viaggio['titolo'];

    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("generale")));

    $page->replaceTag('ADM-CONTENUTO', (new \html\components\AdmSuccesso($t,$str)));

    echo $page;


