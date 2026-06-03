<?php
require_once(ROOT."models/categorieModel.php");
$allCategorie = function (){
    $errors=[];
    $save = [];
    $categories = allCategorie();
    if(isset($_REQUEST["envoie"])){
        $save = $_POST;
        $errors = validateCategorie($save);
        if(empty($errors)){
            // var_dump($save);
            ajoutCategorie($save);
            redirectTo("categories","allCategorie");
        }
    }
    // require_once(ROOT."views/categorie/categorie.php");
    loadView("categorie/categorie",compact("errors","save","categories"));
};

$pages = [
    "allCategorie" =>  $allCategorie,
];
$page = $_REQUEST["page"] ?? "allCategorie";

if(array_key_exists($page,$pages)){
    $pages[$page]();
}else{
    echo "page introuvable";
    exit();
}