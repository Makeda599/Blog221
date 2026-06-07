-- Active: 1778675249312@@localhost@3306@Blog221
USE Blog221;
CREATE TABLE utilisateurs (
    id  INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL, 
    telephone VARCHAR(20) UNIQUE,
    role ENUM('lecteur',"auteur"),
    photo VARCHAR(255)
)

CREATE TABLE categorie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL, 
    description TEXT NOT NULL,
    date DATE NOT NULL,
    statut ENUM('en_attente', 'publie', 'restreinte') DEFAULT 'en_attente', 
    photo VARCHAR(255),
    id_categorie INT NOT NULL,
    id_auteur INT NOT NULL,
    
    CONSTRAINT FK_CategorieArticle FOREIGN KEY (id_categorie) REFERENCES categories(id) ON DELETE CASCADE,
    CONSTRAINT FK_AuteurArticle FOREIGN KEY (id_auteur) REFERENCES utilisateurs(id) ON DELETE CASCADE
);
-- 1. Supprime l'ancienne table si elle existe
-- DROP TABLE IF EXISTS commentaires;

-- 2. Recrée la table avec toutes les relations nécessaires
CREATE TABLE commentaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contenu TEXT NOT NULL,
    date DATE NOT NULL,
    article_id INT NOT NULL, 
    utilisateur_id INT NOT NULL, 
    
    CONSTRAINT FK_ArticleCommentaire FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
    CONSTRAINT FK_UtilisateurCommentaire FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS signalement_articles;

CREATE TABLE signalement_articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT NOT NULL,
    utilisateur_id INT NOT NULL,
    motif VARCHAR(255) NOT NULL, 
    description TEXT, 
    date_signalement DATETIME DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('en_attente', 'traite', 'rejete') DEFAULT 'en_attente',
    
    CONSTRAINT fk_signalement_article 
        FOREIGN KEY (article_id) REFERENCES articles(id) 
        ON DELETE CASCADE,
    CONSTRAINT fk_signalement_auteur 
        FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) 
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Pour la table article
-- ALTER TABLE articles 
-- ADD COLUMN is_archived TINYINT(1) DEFAULT 0;

-- -- Pour la table commentaire
-- ALTER TABLE commentaires 
-- ADD COLUMN is_archived TINYINT(1) DEFAULT 0;
-- ALTER TABLE articles DROP COLUMN is_archived;
-- ALTER TABLE commentaires DROP COLUMN is_archived;


CREATE TABLE IF NOT EXISTS signalement_commentaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    motif VARCHAR(255) NOT NULL,
    description TEXT,
    date_signalement DATETIME DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('en_attente', 'traite', 'rejete') DEFAULT 'en_attente',
    utilisateur_id INT,
    commentaire_id INT,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (commentaire_id) REFERENCES commentaires(id) ON DELETE CASCADE
);