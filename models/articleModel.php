<?php
function validateArticle(array $data){
    $rules = [
        "id_categorie" => ["obligatoire"],
        "titre" => ["obligatoire"],
        "date" =>["obligatoire"],
        "description" => ["obligatoire"],
    ];
    return validate($data ,$rules);
}

function ajoutArticle (array $data){
    $sql = "INSERT INTO articles (titre ,description,date,statut,image,id_categorie,id_auteur) VALUES (:titre , :description, :date, :statut, :image, :id_categorie, :id_auteur)";

    $params = [
        "titre"        => $data['titre'],
        "description"  => $data['description'],
        "date"         => $data['date'],
        "statut"       => $data['statut'], 
        "image"        => $data['image'],                  
        "id_categorie" => $data['id_categorie'],
        "id_auteur"    => $data['id_auteur']
    ];

    return executeUpdate($sql, $params);
}

function getAllArticleByAuteur(int $id){
    $sql = "SELECT a.*, u.nom, u.prenom, c.nom AS categorie_nom 
            FROM articles a
            INNER JOIN utilisateurs u ON a.id_auteur = u.id
            INNER JOIN categories c ON a.id_categorie = c.id
            WHERE a.id_auteur = ?" ;
            
    return executeSelect($sql, [$id], false);
}
function getDetailArticle(int $id){
     $sql = "SELECT a.*, u.nom, u.prenom, c.nom AS categorie_nom ,u.photo as photo 
            FROM articles a
            INNER JOIN utilisateurs u ON a.id_auteur = u.id
            INNER JOIN categories c ON a.id_categorie = c.id
            WHERE a.id = ?" ;
            
    return executeSelect($sql, [$id], true);
}

function getAllArticles(){
    $sql = "SELECT a.*, u.nom, u.prenom, c.nom AS categorie_nom 
            FROM articles a
            INNER JOIN utilisateurs u ON a.id_auteur = u.id
            INNER JOIN categories c ON a.id_categorie = c.id"
            ;
            
    return executeSelect($sql);
}

function publierArticle(int $id){
    $sql ="UPDATE articles SET statut = 'publie' WHERE id = :id";
   executeUpdate($sql,["id" => $id]);
}
function restreindreArticle(int $id){
    $sql ="UPDATE articles SET statut = 'restreinte' WHERE id = :id";
   executeUpdate($sql,["id" => $id]);
}


function getArticlesALaUne(int $limite = 4) {
    $sql = "SELECT a.*, c.nom AS categorie_nom, u.prenom, u.nom, u.photo 
            FROM articles a
            JOIN categories c ON a.id_categorie = c.id
            JOIN utilisateurs u ON a.id_auteur = u.id
            WHERE a.statut = 'publie' 
            ORDER BY a.date DESC 
            LIMIT " . (int)$limite;
            
    return executeSelect($sql); 
}

function getArticlesRecents(int $limite = 6, int $offset = 4) {
    $sql = "SELECT a.*, c.nom AS categorie_nom, u.prenom, u.nom, u.photo 
            FROM articles a
            JOIN categories c ON a.id_categorie = c.id
            JOIN utilisateurs u ON a.id_auteur = u.id
            WHERE a.statut = 'publie' 
            ORDER BY a.date DESC 
            LIMIT " . (int)$limite . " OFFSET " . (int)$offset;
            
    return executeSelect($sql); 
}