<?php

use controllers\AdmController;
use controllers\RouteController;
    use controllers\TravelController;
    use html\components\AdmDashBoard;
    use html\components\AdmFooter;
    use html\components\AdmSuccesso;
    use html\components\Breadcrumb;
    use html\components\FormViaggio;
    use html\components\Head;
    use html\Template;
    use model\BreadcrumbItem;

    require_once('../autoload.php');

    RouteController::protectedRoute();

    $page = new Template('board');

    $error=array();

    // Set page head
    $page->replaceTag('HEAD', (new Head));

    $page->replaceTag('ADM-MENU', (new AdmDashboard("modifica_viaggio")));
    
    $page->replaceValue('TYPE', "MODIFICA VIAGGIO");
    
    //controllo se c'è stata una richiesta post
    if(!empty($_POST)) {

        $admController = new AdmController();
        $form = new FormViaggio($error, null, null, false);
        $viaggio = $form->estraiDatiViaggio();
        $t = $viaggio['titolo'];

        $travelController = new TravelController((int)$viaggio['id']);

        #da gestire il campo 'immagini'
        if($viaggio['titolo']=='' || $viaggio['descrizione']=='' || $viaggio['stato']=='' || $viaggio['citta']=='' || $viaggio['datainizio']=='' || $viaggio['datafine']=='' || $viaggio['prezzo']=='' || $viaggio['descrizioneBreve']==''){
            array_push ( $error , "I campi titolo, descrizione dettagliata, descrizione breve, stato, città, data di inizio, data di fine, prezzo e immagine non possono essere vuoti");
        }

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

            $page->replaceTag('ADM-CONTENUTO', (new AdmSuccesso($t,$str)));

        }
        else{
            $page->replaceTag('ADM-CONTENUTO', (new FormViaggio($error,$travelController->travel,$travelController->getIdTag(), false)));
        }

    } else{
        $id= $_GET['par_id'];
        $travelController = new TravelController((int)$id);
        $page->replaceTag('ADM-CONTENUTO', (new FormViaggio($error,$travelController->travel,$travelController->getIdTag(), false)));
        
    }
    $breadcrumb=array(
        new BreadcrumbItem("./index.php","Pannello di amministrazione"),
        new BreadcrumbItem("./search.php","Ricerca viaggi"),
        new BreadcrumbItem("./form_modifica.php","Modifica viaggio")
    );
    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));
    
    $page->replaceTag('PAGE-SELECTOR', '');

    $page->replaceTag('ADM-FOOTER', (new AdmFooter()));

    echo $page;