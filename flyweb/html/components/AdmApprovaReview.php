<?php
require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

     $admController = new \controllers\AdmController();

     $post = json_decode(file_get_contents('php://input'), true);   
     $id_review = $post['id_recensione'];  
     $tipo_richiesta = $post['tipo_richiesta'];
     
     if($tipo_richiesta === "approvazione"){
          $admController->approveReview($id_review);
     }else{
          $admController->deleteReview($id_review);
     }
?> 