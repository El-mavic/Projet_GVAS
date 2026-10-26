CREATE DATABASE IF NOT EXISTS port_folio_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE port_folio_db;

CREATE TABLE IF NOT EXISTS users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  metier VARCHAR(150) DEFAULT '',
  bio TEXT,
  competences VARCHAR(500) DEFAULT '',
  photo VARCHAR(255) DEFAULT NULL,
  cover_photo VARCHAR(255) DEFAULT NULL,
  cv_path VARCHAR(255) DEFAULT NULL,
  telephone VARCHAR(50) DEFAULT NULL,
  localisation VARCHAR(150) DEFAULT NULL,
  formation TEXT DEFAULT NULL,
  experience TEXT DEFAULT NULL,
  certifications TEXT DEFAULT NULL,
  langues VARCHAR(255) DEFAULT NULL,
  centre_interet VARCHAR(500) DEFAULT NULL,
  site_web VARCHAR(255) DEFAULT NULL,
  linkedin VARCHAR(255) DEFAULT NULL,
  public TINYINT(1) NOT NULL DEFAULT 0,
  payment_status ENUM('unpaid','pending','paid','failed') NOT NULL DEFAULT 'unpaid',
  payment_reference VARCHAR(100) DEFAULT NULL,
  paid_at DATETIME DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FULLTEXT KEY recherche_fulltext (nom, metier, competences, bio)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS projets (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  titre VARCHAR(180) NOT NULL,
  description TEXT,
  image VARCHAR(255) DEFAULT NULL,
  lien VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_projets_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS publication_payments (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  reference VARCHAR(100) NOT NULL UNIQUE,
  provider VARCHAR(40) NOT NULL DEFAULT 'Yabetoo Pay',
  amount INT UNSIGNED NOT NULL,
  currency CHAR(3) NOT NULL DEFAULT 'XAF',
  status ENUM('pending','paid','failed','cancelled') NOT NULL DEFAULT 'pending',
  provider_transaction_id VARCHAR(150) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  paid_at DATETIME DEFAULT NULL,
  INDEX idx_publication_payments_user (user_id, created_at),
  CONSTRAINT fk_publication_payments_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Compte administrateur initial. Mot de passe temporaire : Admin@2026!
-- Changez-le dès la première connexion dans admin_dashboard.php.
CREATE TABLE IF NOT EXISTS admin_accounts (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(80) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO admin_accounts (username, password_hash)
VALUES ('admin', '$2y$12$Cf1Rqy8lOD9pfwh36EsFjurBxvA/7uzFzv8JRgjrrbmjvYDCNjJ.y')
ON DUPLICATE KEY UPDATE username = VALUES(username);
