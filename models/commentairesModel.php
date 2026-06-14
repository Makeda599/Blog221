<?php
require_once(ROOT."validation/validation.php");

function validateCommentaire(array $data): array {
    $rules = [
        "contenu" => ["obligatoire"],
    ];
    return validate($data, $rules);
}

function ajoutCommentaire(array $data) {
    $sql = "INSERT INTO commentaires (contenu, date, article_id, utilisateur_id) 
            VALUES (:contenu, :date, :article_id, :utilisateur_id)";
            
    $params = [
        "contenu"        => $data["contenu"],
        "date"           => $data["date"],
        "article_id"     => $data["article_id"],
        "utilisateur_id" => $data["utilisateur_id"]
    ];

    return executeUpdate($sql, $params);
}

function getCommentairesByArticle(int $articleId) {
    $sql = "SELECT c.*, u.nom, u.prenom, u.photo 
            FROM commentaires c
            INNER JOIN utilisateurs u ON c.utilisateur_id = u.id
            WHERE c.article_id = ? AND c.statut = 'publie'
            ORDER BY c.id DESC"; 
            
    return executeSelect($sql, [$articleId], false);
}

function archiverCommentaire(int $id) {
    $sql = "UPDATE commentaires SET statut ='restreinte' WHERE id = :id";
    return executeUpdate($sql, ["id" => $id]);
}
function publierCommentaire(int $id) {
    $sql = "UPDATE commentaires SET statut ='publie' WHERE id = :id";
    return executeUpdate($sql, ["id" => $id]);
}

function getAllCommentaire(){
     $sql = "SELECT c.*, u.nom, u.prenom, u.photo 
            FROM commentaires c
            INNER JOIN utilisateurs u ON c.utilisateur_id = u.id
            ORDER BY c.id DESC"; 
            
    return executeSelect($sql);
}

