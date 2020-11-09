<?php
    $tags = $_POST['tagDaInviare'];
    $titolo = $_POST['titolo'];
    $dataInizio = $_POST['datainizio'];     //ricordarsi conversione: date('d-m-Y',strtotime($_POST['data_da_post']));
    $dataFine = $_POST['datafine'];
    $prezzo = $_POST['prezzo'];
    $immagini = $_POST[''];     //immagini multiple da method, come fare?


    $dataI = date('d-m-Y',strtotime($dataInizio));
    $dataF = date('d-m-Y',strtotime($dataFine));

    echo "riepilogo dati da inserire nel db <br>";
    echo "titolo: ".$titolo."<br>";
    echo "dataInizio: ".$dataI."<br>";
    echo "dataFine: ".$dataF."<br>";
    echo "prz: ".$prezzo."<br>";
    echo "tags: ".$tags."<br>";



?>