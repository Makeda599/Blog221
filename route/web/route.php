<?php

function routes(){
    return  [
        "auth" => ROOT."controllers/authController.php",
    ];
}
function gestionController(){
    $routes = routes();
    $controller = $_REQUEST["controller"] ?? "auth";

    if(!array_key_exists($controller, $routes)){
        echo "controleur introuvable";
        return;
    }
    if(array_key_exists($controller,$routes)){
        require_once($routes[$controller]);
    }
}