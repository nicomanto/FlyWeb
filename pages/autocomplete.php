<?php  
require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

/*
     script php che restituisce la lista di tag sottoforma di <option> che vanno inseriti dentro <datalist>
*/


     $autocompleteController = new \controllers\FormInserimentoViaggioController();


     $result = $autocompleteController->getTags();



      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= ' <option id='.$row["Nome"].'>'.$row["Nome"].'</option> ';  
           }  
      }  
      else  
      {  
           $output .= ' nessun tag del genere ';  
      }  
      $output .= '';
      echo $output;  
 ?> 