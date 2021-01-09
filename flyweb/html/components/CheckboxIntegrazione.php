<?php  
require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

/*
     script php che restituisce la lista di integrazioni sottoforma di <option> che vanno inseriti dentro <datalist>
*/

     //echo "!! ".$_POST['id'];

     $autocompleteController = new \controllers\IntegrazioneController();

     extract($_GET, EXTR_SKIP);

     //$result = $autocompleteController->getIntegrazioni((int)$_GET['id']);

     $result = $autocompleteController->getAllIntegrazioni();


     //print_r($result);

     foreach($result as $row) { 
          //echo $id . " => " . $nome . "\n";
               
          $output .= '<label for='.$row['ID_Integrazione'].'> <input type="checkbox" id='.$row['ID_Integrazione'].'>'.$row['Nome'].' - '.$row['Prezzo'].' euro</label>';
          $output .= '<br>';
          //echo $output;
     }

     //$output .= '';
     echo $output;
 ?> 