<?php
    use controllers\RouteController;
    use model\Paginator;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();

    #controllo se sono presenti richieste post per eliminazione o accettazione review
    $admController = new \controllers\AdmController();
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


    $page = new \html\template('board');
    $admController = new \controllers\AdmController;

    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("modera_recensioni")));

    $breadcrumb=array(
        new model\BreadcrumbItem("/admin/index.php","Pannello di amministrazione"),
        new model\BreadcrumbItem("/admin/moderazione_recensioni.php","Modera recensioni")
    );
    $page->replaceTag('BREADCRUMB', (new \html\components\Breadcrumb($breadcrumb)));

    if($admController->haveUnapprovedReviews()){
        $unapprovedRev = $admController->getUnapprovedReviewsList();
        $paginatedReview = Paginator::paginate($unapprovedRev, $count);

        $searchResults="";

        foreach ($paginatedReview['elements'] as $element) {
            $searchResults.= (new \html\components\AdmTravelReviewItem((new \model\Review($element))));
        }

        $page->replaceTag('ADM-CONTENUTO',"<ul>".$searchResults."</ul>");

        $page->replaceTag('PAGE-SELECTOR',(new \html\components\pageSelector($paginatedReview)));
    }else{
        $page->replaceTag('ADM-CONTENUTO',"<h2>Nessun recensione da moderare...per ora.</h2>");
    }

    $page->replaceTag('ADM-FOOTER', (new \html\components\AdmFooter()));

    echo $page;