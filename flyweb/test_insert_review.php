<?php

    //pagina che uso per test php, andrà rimossa
    require_once($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/autoload.php');

    $page = new \html\components\formInsertReview(2,2);

    echo $page;