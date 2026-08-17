CREATE DATABASE IF NOT EXISTS gvas CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gvas;

CREATE TABLE IF NOT EXISTS inscriptions (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    matricule VARCHAR(50) NOT NULL UNIQUE,
    nom VARCHAR(100) NOT NULL,
    prenoms VARCHAR(150) NOT NULL,
    sexe ENUM('Masculin','Féminin') NOT NULL,
    date_naissance DATE NOT NULL,
    lieu_naissance VARCHAR(150) NOT NULL,
    nationalite VARCHAR(80) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    telephone VARCHAR(30) NOT NULL,
    niveau_etudes VARCHAR(100) NOT NULL,
    profession VARCHAR(120) NULL,
    type_formation VARCHAR(120) NOT NULL,
    date_debut DATE NOT NULL,
    urgence_nom VARCHAR(180) NOT NULL,
    urgence_telephone VARCHAR(30) NOT NULL,
    photo VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS admins (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(60) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO admins (username, password)
SELECT 'admin', '$2y$12$I0UTjA56igzSaqQYGPyVU.O9EJop42ZJQvELFSxDRZPIpmudRBBIW'
WHERE NOT EXISTS (SELECT 1 FROM admins WHERE username='admin');
