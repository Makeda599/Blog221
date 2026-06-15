<?php
require_once(ROOT."validation/validation.php");
function validateCategorie(array $data):array{
    $rules = [
        "nomCategorie" => ["obligatoire"],
    ];
    return validate($data,$rules);
}

function ajoutCategorie(array $data){
    $sql = "INSERT INTO categories (nom) VALUES (:nomCategorie)";
    executeUpdate($sql,["nomCategorie" => $data["nomCategorie"]]);
}
function allCategorie(){
    $sql = "SELECT * FROM categories";
    return executeSelect($sql);
}