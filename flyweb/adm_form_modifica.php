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
    use controllers\ImagesController;

    require_once('./autoload.php');

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


        $imageController = new ImagesController();

        if($_FILES['immagine']!=''){
            $viaggio['immagine'] = $imageController->saveUploadedImage($_FILES['immagine']);
        }

        
        $travelController = new TravelController((int)$viaggio['id']);

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

        if($viaggio['altImmagine']==''){
            array_push ( $error , 'Campo <abbr title="Testo alternativo">alt</abbr> immagine mancante');
        }

        if($viaggio['descrizioneBreve']==''){
            array_push ( $error , "Campo descrizione breve mancante");
        }

        if($viaggio['datafine']<$viaggio['datainizio']){
            array_push ( $error , "Campi data - data di inizio dev'essere antecedente alla data di fine");
        }


        if($viaggio['prezzo']<0){
            array_push ( $error , "Campo prezzo - Il prezzo non può essere negativo");
        }

        #print_r($_FILES);

        
        
        if(strlen($viaggio['descrizioneBreve'])>200){
            array_push ( $error , "Campo descrizione breve - la descrizione deve avere un massimo di 200 caratteri");
        }

        if(strlen($viaggio['altImmagine'])<5 || strlen($viaggio['altImmagine'])>50){
            array_push ( $error , 'Campo <abbr title="Testo alternativo">alt</abbr> immagine - la descrizione deve avere un minimo di 5 caratteri ed un massimo di 50 caratteri');
        }

       
         //controllo se ci sono errori, in tal caso non invio la richiesta al database
        if(empty($error)){
            $str= "aggiornamento";
            $admController->resetTagViaggio($viaggio['id']);
            $admController->aggiornaViaggio($viaggio);
            if(! empty($viaggio['tag'])){
                $admController->setTagViaggio($viaggio['id'],$viaggio['tag']);
            }

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
        new BreadcrumbItem("./adm_index.php","Pannello di amministrazione"),
        new BreadcrumbItem("./adm_search.php","Ricerca viaggi"),
        new BreadcrumbItem("#","Modifica viaggio")
    );
    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    
    $page->replaceTag('PAGE-SELECTOR', "");

    $page->replaceTag('ADM-FOOTER', (new AdmFooter()));

    echo $page;