-- À exécuter une seule fois dans la base de données du projet.
-- Crée la table qui stocke les réalisations de chaque membre.
CREATE TABLE IF NOT EXISTS projets (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  titre VARCHAR(180) NOT NULL,
  description TEXT DEFAULT NULL,
  image VARCHAR(255) DEFAULT NULL,
  lien VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_projets_user_date (user_id, created_at),
  CONSTRAINT fk_projets_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
