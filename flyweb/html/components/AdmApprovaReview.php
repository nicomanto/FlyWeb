<?php
require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

/*
     script php che restituisce la lista di tag sottoforma di <option> che vanno inseriti dentro <datalist>
*/

     $post = json_decode(file_get_contents('php://input'), true);   
     $id_review = $post['id_recensione'];  



     $admController = new \controllers\AdmController();

     $admController->approveReview($id_review);

     echo "Recensione approvata";  
 ?> 