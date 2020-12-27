<?php
    use controllers\RouteController;
    use controllers\UserController;
    use model\User;
    use html\components\AdmInfoHome;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    // This route can be accessed only by admins
    RouteController::protectedRoute();

    


    $page = new \html\template('board');


    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-MENU', (new \html\components\AdmDashboard));

    $page->replaceValue('TITOLO', "PAGINA AMMINISTRATORE");


    $page->replaceTag('ADM-CONTENUTO', new html\components\AdmInfoHome());

    echo $page;