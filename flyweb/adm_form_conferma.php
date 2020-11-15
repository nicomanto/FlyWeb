<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    $page = new \html\template('board');

    $admController = new \controllers\AdmController();
    $form = new \html\components\FormViaggio();
    $datiViaggio = $form->estraiDatiViaggioDaForm();

    /*
    //print debug
    foreach ($datiViaggio as $key => $value) {
        echo "Key: $key; Value: $value\n";
    }
    */

    $admController->inserisciViaggio($datiViaggio);

    $page->replaceTag('HEAD', (new \html\components\head));

    $page->replaceTag('ADM-FORM-INSERIMENTO-VIAGGIO', '');

    $t = $datiViaggio['titolo'];

    $page->replaceTag('ADM-SUCCESSO', (new \html\components\AdmSuccessoInserimento($t) ));

    echo $page;


