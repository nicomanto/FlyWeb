<?php

require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

 

    $admController = new \controllers\AdmController();
    $nome = $_COOKIE['flw_user'];
    $id=$admController->getIDFromUsername($nome);
    $userController= new \controllers\UserController($id['ID_Utente']);
    $reviews = $userController->getReviewUtente($id['ID_Utente']);

    $_page= new \html\template('profilo');

    
    $_page->replaceTag('HEAD', (new \html\components\head));

    
    $_page->replaceTag('NAV-MENU', (new \html\components\NavMenu));


    $_page->replaceTag('PROFILOMENU', (new \html\components\ProfiloMenu));


    if (empty($reviews)) {
        $_page->replaceTag('RECENSIONI-PROFILO', ("Non hai ancora lasciato nessuna recensione"));
        //dovrei fare un componente apposito per segnalare il non aver ancora lasciato recensioni?
    }
    else {
        $_page->replaceTag('RECENSIONI-PROFILO', (new \html\components\travelReviews($reviews)));
    }
    
    $_page->replaceTag('FOOTER', (new \html\components\footer));

    echo $_page;