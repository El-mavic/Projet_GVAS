-- À exécuter UNE SEULE FOIS dans la base port_folio_db via phpMyAdmin.
-- Compte initial : identifiant admin / mot de passe Admin@2026!
-- Connectez-vous puis changez immédiatement ce mot de passe dans le dashboard.
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
