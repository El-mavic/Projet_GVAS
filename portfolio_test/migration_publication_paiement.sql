-- À exécuter UNE SEULE FOIS après sauvegarde de la base existante.
-- Les anciens profils sont repassés en privé pour qu'aucun ne soit considéré comme payé automatiquement.
ALTER TABLE users
  ADD COLUMN payment_status ENUM('unpaid','pending','paid','failed') NOT NULL DEFAULT 'unpaid' AFTER public,
  ADD COLUMN payment_reference VARCHAR(100) DEFAULT NULL AFTER payment_status,
  ADD COLUMN paid_at DATETIME DEFAULT NULL AFTER payment_reference;

UPDATE users SET public = 0, payment_status = 'unpaid', payment_reference = NULL, paid_at = NULL;

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
