-- À exécuter UNE SEULE FOIS sur une base déjà existante, après sauvegarde.
-- Harmonise le nom du fournisseur dans l'historique des transactions.
ALTER TABLE publication_payments
  MODIFY provider VARCHAR(40) NOT NULL DEFAULT 'Yabetoo Pay';

UPDATE publication_payments
SET provider = 'Yabetoo Pay'
WHERE LOWER(provider) IN ('gab2pay', 'yabetoo', 'yabetoo pay');
