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
function validateUserModification(array $data):array{
    $rules = [
        "nom" => ["obligatoire"],
        "prenom" => ["obligatoire"],
        "email" => ["obligatoire","email"],
        "role" =>["obligatoire"],
        "telephone" =>["obligatoire","regex:/^(70|75|76|77|78)[0-9]{7}$/"],

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
function getAllUsers() :array{
    $sql = "SELECT * FROM utilisateurs ";
    $resultat = executeSelect($sql);
    return $resultat;
    }

 function deconnexion(){
    session_destroy();
    session_unset();
 }

function deleteUser(int $id){
    $sql= "DELETE FROM utilisateurs WHERE id = :id";
    executeUpdate($sql,["id" => $id]);
}
function updateUser(array $data){
    $sql = "UPDATE utilisateurs SET 
                nom = :nom, 
                prenom = :prenom, 
                telephone = :telephone, 
                email = :email, 
                photo = :photo,
                `role` = :role 
            WHERE id = :id";
    $user = [
        'nom'       => $data['nom'],
        'prenom'    => $data['prenom'],
        'telephone' => $data['telephone'],
        'email'     => $data['email'],
        'role'      => $data['role'],
        'photo' =>    $data['photo'],
        'id'        => (int)$data['id'],
    ];
    executeUpdate($sql,$user);
}
function getUserById(int $id) :?array{
    $sql = "SELECT * FROM utilisateurs  WHERE id = :id";
    $resultat = executeSelect($sql, ["id" => $id], $one = true);
    return $resultat ? $resultat : null;
    }
