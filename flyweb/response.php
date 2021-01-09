<?php

    use controllers\ReviewController;
    use controllers\RouteController;
    use html\components\Head;
    use html\components\ResponseMessage;
    use html\Template;
    use model\Review;

    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');
    RouteController::loggedRoute();

    if (empty($_POST)) {
      header('location:/index.php');
      exit();
    }


    $page = new Template('response');

    // Set page head
    $page->replaceTag('HEAD', (new Head));

    switch ($_POST['type']) {
        case 'inserimentoRecensioneUser':

            $review = new Review($_POST['titolo'],$_POST['valutazione'],$_POST['descrizione'],$_POST['id_utente']);
            (new ReviewController())->insertReview($review,$_POST['id_viaggio']);

            $page->replaceTag('RESPONSE', (new ResponseMessage("Recensione inserita con successo, grazie!")));
            
          break;
        default:
          echo "Campo sbagliato";
    }

    echo $page;