<?php

    use controllers\RouteController;
    use controllers\ImagesController;
    use controllers\AdmController;
    use html\components\AdmDashBoard;
    use html\components\AdmSuccesso;
    use html\components\Breadcrumb;
    use html\components\AdmFooter;
    use html\components\FormViaggio;
    use html\components\Head;
    use html\Template;
    use model\BreadcrumbItem;

    require_once('./autoload.php');
    use model\Travel;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();

    $page = new Template('board');

    $error=array();

    $page->replaceTag('HEAD', (new Head));

    $breadcrumb=array(
        new BreadcrumbItem("./index.php","Pannello di amministrazione"),
        new BreadcrumbItem("./adm_form_inserimento.php","Inserimento viaggio")
    );
    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    $page->replaceTag('ADM-MENU', (new AdmDashboard("inserisci_viaggio")));


    $page->replaceValue('TYPE', "INSERISCI VIAGGIO");

    //controllo se c'è stata una richiesta post
    if(!empty($_POST)) {

        $admController = new AdmController();
        $form = new FormViaggio($error);
        $viaggio = $form->estraiDatiViaggio();
        //print_r($viaggio);
        $temp_travel=new Travel($viaggio['titolo'], $viaggio['datainizio'], $viaggio['datafine'], (int)$viaggio['prezzo'], $viaggio['descrizione'], $viaggio['descrizioneBreve'],$viaggio['stato'], $viaggio['citta'], $viaggio['localita']);
        //print_r($temp_travel);
        
        $t = $viaggio['titolo'];

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

        print_r($_FILES);

        $imageController = new ImagesController();
        $viaggio['immagine'] = $imageController->saveUploadedImage($_FILES['immagine']);
        
        if(strlen($viaggio['descrizioneBreve'])<100 || strlen($viaggio['descrizioneBreve'])>300){
            array_push ( $error , "Campo Descrizione Breve - la descrizione deve avere un minimo di 100 caratteri ed un massimo di 300 caratteri");
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


            $page->replaceTag('ADM-CONTENUTO', (new AdmSuccesso($t,$str)));
        }
        else{
            
            $page->replaceTag('ADM-CONTENUTO', (new \html\components\FormViaggio($error,$temp_travel,$viaggio['tag'])));
        }
    }
    else{
        $page->replaceTag('ADM-CONTENUTO', (new \html\components\FormViaggio($error,$temp_travel,$viaggio['tag'])));
        
    }
    $page->replaceTag('PAGE-SELECTOR', '');

    $page->replaceTag('ADM-FOOTER', (new AdmFooter()));

    echo $page;