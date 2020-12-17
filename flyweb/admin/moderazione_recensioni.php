<?php
    use controllers\RouteController;
    use model\Paginator;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    RouteController::protectedRoute();

    $count = isset($page) ? $page : 1;


    $page = new \html\template('board');
    $admController = new \controllers\AdmController;

    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard("modera_recensioni")));

    if($admController->haveUnapprovedReviews()){
        $unapprovedRev = $admController->getUnapprovedReviewsList();
        $paginatedReview = Paginator::paginate($unapprovedRev, $count);
        $page->replaceTag('ADM-CONTENUTO', (new \html\components\AdmContainerList($paginatedReview,"LISTA RECENSIONI")));
    }else{
        $page->replaceTag('ADM-CONTENUTO', (new \html\components\AdmEmptyContainer("LISTA RECENSIONI")));
    }

    echo $page;