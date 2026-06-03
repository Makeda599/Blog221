<?php
require_once(ROOT."validation/validation.php");
function validateUserInscription(array $data):array{
    $rules = [
        "nom" => ["obligatoire"],
        "prenom" => ["obligatoire"],
        "email" => ["obligatoire","email"],
        "role" =>["obligatoire"],
        "telephone" =>["obligatoire","regex:/^(70|75|76|77|78)[0-9]{7}$/"],
        "mot_de_passe" => ["obligatoire"],

    ];
    return validate($data,$rules);
}
function validateUserConnexion(array $data):array{
    $rules = [
        "email" => ["obligatoire","email"],
        "mot_de_passe" => ["obligatoire"],

    ];
    return validate($data,$rules);
}

function getClientByMail(string $email) :?array{
    $sql = "SELECT * FROM utilisateurs  WHERE email = :email";
    $resultat = executeSelect($sql, ["email" => $email], $one = true);
    return $resultat ? $resultat : null;
    }

function saveUser(array $data){
    $sql = "INSERT INTO utilisateurs (nom, prenom,telephone,email,mot_de_passe,role,photo) VALUES (:nom, :prenom, :telephone, :email,:mot_de_passe,:role,:photo)";
    executeUpdate($sql,$data);
}

 function deconnexion(){
    session_destroy();
    session_unset();
 }