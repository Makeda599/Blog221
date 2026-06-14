<?php
function validateSignalArticle(array $data){
    $rules = [
        "motif" => ["obligatoire"],
    ];
    return validate($data ,$rules);
}
function getDetailCommentairePourSignalement(int $id) {
  
    $sql = "SELECT c.*, a.titre AS article_titre 
            FROM commentaires c 
            JOIN articles a ON c.article_id = a.id 
            WHERE c.id = :id";
    return executeSelect($sql, ['id' => $id], true);
}
function ajoutSignalCommentaire(array $data){
    $sql = "INSERT INTO signalement_commentaires 
            (motif, date_signalement, statut, commentaire_id, utilisateur_id, description) 
            VALUES 
            (:motif, :date_signalement, :statut, :commentaire_id, :utilisateur_id, :description)";
            
    $dataSignal = [
        "motif"            => $data["motif"],
        "date_signalement" => $data["date_signalement"],
        "statut"           => $data["statut"],
        "commentaire_id"   => (int)$data["commentaire_id"],
        "utilisateur_id"   => (int)$_SESSION['user']['id'],
        "description"      => $data["description"] ?? null
    ];
    
    executeUpdate($sql, $dataSignal);
}
function getAllSignalements() {
    $sql = "
        /* 1. Signalements d'ARTICLES */
        SELECT 
            sig.id, 
            sig.motif, 
            sig.description, 
            sig.date_signalement, 
            sig.statut AS statut,
            'article' AS type_signalement,
            sig.article_id AS article_id,      
            NULL AS commentaire_id,           
            u.nom AS nom_signaleur, 
            u.prenom AS prenom_signaleur, 
            u.photo AS photo_signaleur,
            a.titre AS titre_cible
        FROM signalement_articles AS sig
        INNER JOIN articles AS a ON sig.article_id = a.id
        INNER JOIN utilisateurs AS u ON sig.utilisateur_id = u.id

        UNION ALL

        /* 2. Signalements de COMMENTAIRES */
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

function traiteSignalementCommentaire(int $id){
    $sql = "UPDATE signalement_commentaires set statut = 'traite' WHERE id = :id ";
    executeUpdate($sql ,["id" => $id]);
}

function RejeterSignalementCommentaire(int $id){
    $sql = "UPDATE signalement_commentaires set statut = 'rejete' WHERE id = :id ";
    executeUpdate($sql ,["id" => $id]);
}