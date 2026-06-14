<?php

function routes(){
    return  [
        "auth" => ROOT."controllers/authController.php",
        "articles" => ROOT."controllers/articleController.php",
        "categories" => ROOT."controllers/categorieController.php",
        "commentaires" =>ROOT."controllers/commentaireController.php",
        "signalArticles" => ROOT."controllers/signalementArtController.php",
        "signalCommentaires" => ROOT."controllers/signalCommentController.php",

    ];
}
function gestionController(){
    $routes = routes();
    $controller = $_REQUEST["controller"] ?? "articles";

    if(!array_key_exists($controller, $routes)){
        echo "controleur introuvable";
        return;
    }
    if(array_key_exists($controller,$routes)){
        require_once($routes[$controller]);
    }
}