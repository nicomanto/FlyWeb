<?php

    use controllers\RouteController;
    use html\components\Head;
    use html\Template;

    require_once('./autoload.php');

    RouteController::unprotectedRoute();


    $page = new Template('error');

    // Set page head
    $page->replaceTag('HEAD', (new Head));

    if(rand(0,1)){
        $image="error_willy.gif";
        $alt="Willy il Coyote (cartone) che viene travolto da un masso";
    }
    else{
        $image="error_spongebob.gif";
        $alt="Spongebob (cartone) confuso";
    }

    $page->replaceValues([
        "ERROR_NUMBER" => "404",
        'DESCRIPTION' => 'Sembra che la pagina che stai cercando non esista o non sia più disponibile',
        'IMAGE' => $image,
        'ALT_IMAGE' => $alt
        
    ]);

    echo $page;