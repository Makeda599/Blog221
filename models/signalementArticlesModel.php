<?php
function validateSignalArticle(array $data){
    $rules = [
        "motif" => ["obligatoire"],
    ];
    return validate($data ,$rules);
}
function ajoutSignalArticle(array $data){
    $sql="INSERT INTO signalement_articles (motif,date_signalement,statut,article_id,utilisateur_id,description) VALUES (:motif, :date_signalement,:statut, :article_id,:utilisateur_id,:description)";
    $dataSignal = [
        "motif" => $data["motif"],
        "date_signalement" => $data["date_signalement"],
        "statut" => $data["statut"],
        "article_id" => $data["article_id"],
        "utilisateur_id"   => $_SESSION['user']['id'],
        "description" =>$data["description"]
    ];
    executeUpdate($sql,$dataSignal);
}
function getAllSignalements() {
    $sql = "
        /* 1. Signalements d'ARTICLES */
        SELECT 
            sig.id, 
            sig.motif, 
            sig.description, 
            sig.article_id AS article_id,  
            NULL AS commentaire_id,
            sig.date_signalement, 
            sig.statut AS statut,
            'article' AS type_signalement,
            u.nom AS nom_signaleur, 
            u.prenom AS prenom_signaleur, 
            u.photo AS photo_signaleur,
            a.titre AS titre_cible /* <--- C'est cette clé qu'il faut utiliser partout */
        FROM signalement_articles AS sig
        INNER JOIN articles AS a ON sig.article_id = a.id
        INNER JOIN utilisateurs AS u ON sig.utilisateur_id = u.id

        UNION ALL

        /* 2. Signalements de COMMENTAIRES (Table vide pour l'instant) */
        SELECT 
            sig.id, 
            sig.motif, 
            sig.description, 
            sig.date_signalement, 
            sig.statut AS statut,
            'commentaire' AS type_signalement,
            NULL AS article_id,            
            sig.commentaire_id AS commentaire_id,
            u.nom AS nom_signaleur, 
            u.prenom AS prenom_signaleur, 
            u.photo AS photo_signaleur,
            c.contenu AS titre_cible
        FROM signalement_commentaires AS sig
        INNER JOIN commentaires AS c ON sig.commentaire_id = c.id
        INNER JOIN utilisateurs AS u ON sig.utilisateur_id = u.id

        ORDER BY date_signalement DESC";

    return executeSelect($sql);
}

function traiteSignalementArticle(int $id){
    $sql = "UPDATE signalement_articles set statut = 'traite' WHERE id = :id ";
    executeUpdate($sql ,["id" => $id]);
}

function RejeterSignalementArticle(int $id){
    $sql = "UPDATE signalement_articles set statut = 'rejete' WHERE id = :id ";
    executeUpdate($sql ,["id" => $id]);
}