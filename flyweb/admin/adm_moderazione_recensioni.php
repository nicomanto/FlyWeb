<?php

use controllers\AdmController;
use controllers\RouteController;
use html\components\AdmDashBoard;
use html\components\AdmFooter;
use html\components\AdmTravelReviewItem;
use html\components\Breadcrumb;
use html\components\Head;
use html\components\PageSelector;
use html\Template;
use model\BreadcrumbItem;
use model\Paginator;
use model\Review;

require_once('../autoload.php');

    RouteController::protectedRoute();

    #controllo se sono presenti richieste post per eliminazione o accettazione review
    $admController = new AdmController();
    if(!empty($_POST)){
        if($_POST['btn_approva']){
            $admController->approveReview($_POST['id_review']);
        }
        else{
            $admController->deleteReview($_POST['id_review']);
        }
    }
    #---------------------------------------------------------------------------------------

    $count = isset($page) ? $page : 1;


    $page = new Template('board');

    $page->replaceTag('HEAD', (new Head));

    $page->replaceTag('ADM-MENU', (new AdmDashboard("modera_recensioni")));

    $breadcrumb=array(
        new BreadcrumbItem("./index.php","Pannello di amministrazione"),
        new BreadcrumbItem("./adm_moderazione_recensioni.php","Modera recensioni")
    );
    $page->replaceTag('BREADCRUMB', (new Breadcrumb($breadcrumb)));

    if($admController->haveUnapprovedReviews()){
        $unapprovedRev = $admController->getUnapprovedReviewsList();
        $paginatedReview = Paginator::paginate($unapprovedRev, $count);

        $searchResults="";

        foreach ($paginatedReview['elements'] as $element) {
            $searchResults.= (new AdmTravelReviewItem((new Review($element))));
        }

        $page->replaceTag('ADM-CONTENUTO',"<ul>".$searchResults."</ul>");

        $page->replaceTag('PAGE-SELECTOR',(new \html\components\pageSelector($paginatedReview)));
    }else{
        $page->replaceTag('ADM-CONTENUTO',"<h2>Nessun recensione da moderare...per ora.</h2>");
    }

    $page->replaceTag('ADM-FOOTER', (new AdmFooter()));

    echo $page;