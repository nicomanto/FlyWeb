<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . 'autoload.php');

    if (empty($_POST)) {
      header('location:index.php');
      exit();
    }


    $page = new \html\template('response');

    // Set page head
    $page->replaceTag('HEAD', (new \html\components\head));

    switch ($_POST['type']) {
        case 'inserimentoRecensioneUser':

            $review = new \model\Review($_POST['titolo'],$_POST['valutazione'],$_POST['descrizione'],$_POST['id_utente']);
            (new \controllers\ReviewController())->insertReview($review,$_POST['id_viaggio']);

            $page->replaceTag('RESPONSE', (new \html\components\responseMessage("Recensione inserita con successo, grazie!")));
            
          break;
        default:
          echo "Campo sbagliato";
    }

    echo $page;