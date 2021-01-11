<?php

    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();

    $page = new Template('board');

    $error=array();

    // Set page head
    $page->replaceTag('HEAD', (new Head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("modifica_viaggio")));
    
    $page->replaceValue('TITOLO', "MODIFICA VIAGGIO");
    
    //controllo se c'è stata una richiesta post
    if(!empty($_POST)) {

        $admController = new \controllers\AdmController();
        $form = new \html\components\FormViaggio($error, null, null, false);
        $viaggio = $form->estraiDatiViaggio();
        $t = $viaggio['titolo'];

        $travelController = new TravelController((int)$viaggio['id']);

        if($viaggio['datafine']<$viaggio['datainizio']){
            array_push ( $error , "Campi Data - data di inizio dev'essere antecedente alla data di fine");
        }


        if($viaggio['prezzo']<0){
            array_push ( $error , "Campo Prezzo - Il prezzo non può essere negativo");
        }

       
         //controllo se ci sono errori, in tal caso non invio la richiesta al database
        if(empty($error)){
            $str= "aggiornamento";
            $admController->resetTagViaggio($viaggio['id']);
            $admController->resetIntegrazioneViaggio($viaggio['id']);
            $admController->aggiornaViaggio($viaggio);
            if(! empty($viaggio['tag'])){
                $admController->setTagViaggio($viaggio['id'],$viaggio['tag']);
            }
            $admController->setIntegrazioniViaggio($viaggio['id'],$viaggio['integrazioni']);

            $page->replaceTag('ADM-CONTENUTO', (new \html\components\AdmSuccesso($t,$str)));

        }
        else{
            $page->replaceTag('ADM-CONTENUTO', (new \html\components\FormViaggio($error,$travelController->travel,$travelController->getIdTag(), false)));
        }

    } else{
        $id= $_GET['par_id'];
        $travelController = new TravelController((int)$id);
        $page->replaceTag('ADM-CONTENUTO', (new \html\components\FormViaggio($error,$travelController->travel,$travelController->getIdTag(), false)));
        
    }
    $breadcrumb=array(
        new BreadcrumbItem("/admin/index.php","Pannello di amministrazione"),
        new BreadcrumbItem("/admin/search.php","Ricerca viaggi"),
        new BreadcrumbItem("/admin/form_modifica.php","Modifica viaggio")
    );
    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));
    

    $page->replaceTag('ADM-FOOTER', (new \html\components\AdmFooter()));

    echo $page;