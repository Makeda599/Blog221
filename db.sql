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