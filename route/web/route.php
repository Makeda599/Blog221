<?php

function routes(){
    return  [
        "auth" => ROOT."controllers/authController.php",
        "articles" => ROOT."controllers/articleController.php",
        "categories" => ROOT."controllers/categorieController.php",
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