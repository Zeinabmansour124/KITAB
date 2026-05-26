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
    location VARCHAR(100),
    rate DECIMAL(3,2) DEFAULT 0.00 CHECK (rate BETWEEN 0 AND 5),
    bio TEXT,
    image VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table books
CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    titre VARCHAR(100) NOT NULL,
    auteur VARCHAR(100),
    prix DECIMAL(10,2),
    genre VARCHAR(50),
    `condition` ENUM('neuf', 'bon', 'moyen', 'abimé') DEFAULT 'bon',
    image VARCHAR(255),
    description TEXT,
    for_exchange BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table exchanges
CREATE TABLE IF NOT EXISTS exchanges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    your_book_id INT NOT NULL,
    user_offering_id INT NOT NULL,
    partner_book_id INT,
    status ENUM('pending', 'accepted', 'in_progress', 'refused', 'completed') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    completed ENUM('yes', 'no') DEFAULT 'no',
    accepted TINYINT DEFAULT 0,
    FOREIGN KEY (your_book_id) REFERENCES books(id) ON DELETE CASCADE,
    FOREIGN KEY (user_offering_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (partner_book_id) REFERENCES books(id) ON DELETE CASCADE,
    FOREIGN KEY (user_requesting_id) REFERENCES users(id) ON DELETE CASCADE
);
