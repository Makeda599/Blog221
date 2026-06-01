<?php

$accueil = function(){
    require_once(ROOT."views/articles/accueil.php");
};

$pages = [
    "accueil" => $accueil,
];
$page = $_REQUEST["page"] ?? "accueil";
if(array_key_exists($page,$pages)){
    $pages[$page]();
}else{
    echo "page introuvable";
    exit();
}