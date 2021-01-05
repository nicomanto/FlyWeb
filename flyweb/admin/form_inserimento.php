<?php

    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();

    $page = new \html\template('board');

    $error=array();

    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("inserisci_viaggio")));

    $page->replaceValue('c', "INSERISCI VIAGGIO");

    //controllo se c'è stata una richiesta post
    if(!empty($_POST)) {

        $admController = new \controllers\AdmController();
        $form = new \html\components\FormViaggio($error);
        $viaggio = $form->estraiDatiViaggio();
        $t = $viaggio['titolo'];


        if($viaggio['datafine']<$viaggio['datainizio']){
            array_push ( $error , "Campi Data - data di inizio dev'essere antecedente alla data di fine");
        }


        if($viaggio['prezzo']<0){
            array_push ( $error , "Campo Prezzo - Il prezzo non può essere negativo");
        }

       
        //controllo se ci sono errori, in tal caso non invio la richiesta al database
        if(empty($error)){
            $str= "inserimento";
            $admController->inserisciViaggio($viaggio);
            $v_id=$admController->getTravelIdByTitle($viaggio['titolo']);
            if(!empty($viaggio['tag'])){
                $admController->setTagViaggio($v_id,$viaggio['tag']);
            }
            $admController->setIntegrazioniViaggio($v_id,$viaggio['integrazioni']);


            $page->replaceTag('ADM-CONTENUTO', (new \html\components\AdmSuccesso($t,$str)));
        }
        else{
            
            $page->replaceTag('ADM-CONTENUTO', (new \html\components\FormViaggio($error)));
        }

    }
    else{
        $page->replaceTag('ADM-CONTENUTO', (new \html\components\FormViaggio($error)));
        
    }

    echo $page;