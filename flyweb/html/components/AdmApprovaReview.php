<?php
require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

/*
     script php che restituisce la lista di tag sottoforma di <option> che vanno inseriti dentro <datalist>
*/

    $idRecensioneDaApprovare = $_POST['id'];

    $admController = new \controllers\AdmController();

    $admController->approveReview($idRecensioneDaApprovare);

    echo "approvata";
 ?> 