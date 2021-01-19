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
        new BreadcrumbItem("#","Inserimento viaggio")
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
        $temp_travel=new Travel($viaggio['titolo'], $viaggio['datainizio'], $viaggio['datafine'], (int)$viaggio['prezzo'], $viaggio['descrizione'], $viaggio['descrizioneBreve'],$viaggio['stato'], $viaggio['citta'], $viaggio['localita'], $viaggio['altImmagine']);
        //print_r($temp_travel);

        $imageController = new ImagesController();
        $viaggio['immagine'] = $imageController->saveUploadedImage(isset($_FILES['immagine'])? $_FILES['immagine'] : array() );
        
        $t = $viaggio['titolo'];


        
        if($viaggio['titolo']==''){
            array_push ( $error , "Campo titolo mancante");
        }

        if($viaggio['descrizione']==''){
            array_push ( $error , "Campo descrizione mancante");
        }

        if($viaggio['stato']==''){
            array_push ( $error , "Campo stato mancante");
        }

        if($viaggio['citta']==''){
            array_push ( $error , "Campo città mancante");
        }

        if($viaggio['datainizio']==''){
            array_push ( $error , "Campo data di inizio mancante");
        }

        if($viaggio['datafine']==''){
            array_push ( $error , "Campo data di fine mancante");
        }

        if($viaggio['prezzo']==''){
            array_push ( $error , "Campo prezzo mancante");
        }

        if($viaggio['immagine']==''){
            array_push ( $error , "Campo immagine mancante");
        }

        if($viaggio['altImmagine']==''){
            array_push ( $error , 'Campo <abbr title="Testo alternativo">alt</abbr> immagine mancante');
        }

        if($viaggio['datafine']<$viaggio['datainizio']){
            array_push ( $error , "Campi data - data di inizio dev'essere antecedente alla data di fine");
        }


        if($viaggio['prezzo']<0){
            array_push ( $error , "Campo prezzo - Il prezzo non può essere negativo");
        }

        #print_r($_FILES);

        
        
        if(strlen($viaggio['descrizioneBreve'])<100 || strlen($viaggio['descrizioneBreve'])>300){
            array_push ( $error , "Campo descrizione breve - la descrizione deve avere un minimo di 100 caratteri ed un massimo di 300 caratteri");
        }

        if(strlen($viaggio['altImmagine'])<5 || strlen($viaggio['altImmagine'])>50){
            array_push ( $error , 'Campo <abbr title="Testo alternativo">alt</abbr> immagine - la descrizione deve avere un minimo di 5 caratteri ed un massimo di 50 caratteri');
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