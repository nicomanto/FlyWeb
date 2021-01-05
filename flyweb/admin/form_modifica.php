<?php

    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();

    $page = new \html\template('board');

    $error=array();

    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("modifica_viaggio")));
    
    $page->replaceValue('TITOLO', "MODIFICA VIAGGIO");
    
    //controllo se c'è stata una richiesta post
    if(!empty($_POST)) {

        $admController = new \controllers\AdmController();
        $form = new \html\components\FormViaggio($error);
        $viaggio = $form->estraiDatiViaggio();
        $t = $viaggio['titolo'];

        $travelController = new \controllers\TravelController((int)$viaggio['id']);

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
            $page->replaceTag('ADM-CONTENUTO', (new \html\components\FormViaggio($error,$travelController->travel,$travelController->getIdTag())));
        }

    } else{
        $id= $_GET['par_id'];
        $travelController = new \controllers\TravelController((int)$id);
        $page->replaceTag('ADM-CONTENUTO', (new \html\components\FormViaggio($error,$travelController->travel,$travelController->getIdTag())));
        
    }
    $breadcrumb=array(
        new model\BreadcrumbItem("/admin/index.php","Pannello di amministrazione"),
        new model\BreadcrumbItem("/admin/search.php","Ricerca viaggi"),
        new model\BreadcrumbItem("/admin/form_modifica.php","Modifica viaggio")
    );
    $page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));
    

    $page->replaceTag('ADM-FOOTER', (new \html\components\AdmFooter()));

    echo $page;