<?php  
require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

/*
    script php che restituisce la lista di tutte le integrazioni sottoforma di <option> che vanno inseriti dentro <datalist>
*/


    $autocompleteController = new \controllers\IntegrazioneController();

    $result = $autocompleteController->getAll();


    //print_r($result);

    foreach($result as $row) { 
        //echo $id . " => " . $nome . "\n";
            
        $output .= '<label for='.$row['ID_Integrazione'].'> <input type="checkbox" id='.$row['ID_Integrazione'].' name="integrazioni[]" value='.$row['ID_Integrazione'].'>'.$row['Nome'].' - '.$row['Prezzo'].' euro </label>';
        $output .= '<br>';
        //echo $output;
    }

     //$output .= '';
     echo $output;
 ?> 