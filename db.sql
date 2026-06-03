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

-- CREATE TABLE signalement_articles (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     motif VARCHAR(255) NOT NULL,
--     date DATE NOT NULL,
--     id_article INT NOT NULL, -- C'est ici qu'on fait la liaison
    
--     CONSTRAINT FK_ArticleSignalement FOREIGN KEY (id_article) REFERENCES articles(id) ON DELETE CASCADE
-- );