-- Script SQL pour la base KITAB avec users et books

-- Création de la base
CREATE DATABASE IF NOT EXISTS kitab CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE kitab;

-- Table users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    avatar VARCHAR(255),
    bio TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table books
CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,                       -- Référence à l'utilisateur qui ajoute le livre
    titre VARCHAR(100) NOT NULL,
    auteur VARCHAR(100),
    prix DECIMAL(10,2),                         -- Prix du livre
    genre VARCHAR(50),
    `condition` ENUM('neuf', 'bon', 'moyen', 'abimé') DEFAULT 'bon',  -- État du livre
    image VARCHAR(255),                          -- URL ou chemin de l'image
    description TEXT,
    for_exchange BOOLEAN DEFAULT FALSE,         -- True si le livre est proposé pour échange
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);