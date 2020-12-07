<?php
    use controllers\RouteController;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();

    $page = new \html\template('board');
    $admController = new \controllers\AdmController;


    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("modera_recensioni")));

    if($admController->haveUnapprovedReviews()){
        $unapprovedRev = $admController->getUnapprovedReviewsList();

        $res='<h1 class="adm-titolo"><strong>LISTA RECENSIONI DA APPROVARE</strong></h1>';

        foreach($unapprovedRev as $r){
            $review= (new \model\Review($r));
            
            $res.= (new \html\components\AdmTravelReviewItem($review));
        }

        $page->replaceTag('ADM-CONTENUTO', $res);
    }else{
        $page->replaceTag('ADM-CONTENUTO', '<h2>Non ci sono recensioni da moderare...per ora</h2>');
    }

    $page->replaceTag('ADM-LIST','');

    $page->replaceTag('FOOTER', (new \html\components\footer));

    echo $page;