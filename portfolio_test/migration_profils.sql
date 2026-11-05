-- À exécuter une seule fois sur la base de données EXISTANTE du projet.
-- Ajoute les champs nécessaires aux CV, photos et renseignements complémentaires.
ALTER TABLE users
  ADD COLUMN cover_photo VARCHAR(255) DEFAULT NULL AFTER photo,
  ADD COLUMN cv_path VARCHAR(255) DEFAULT NULL AFTER cover_photo,
  ADD COLUMN telephone VARCHAR(50) DEFAULT NULL AFTER cv_path,
  ADD COLUMN localisation VARCHAR(150) DEFAULT NULL AFTER telephone,
  ADD COLUMN formation TEXT DEFAULT NULL AFTER localisation,
  ADD COLUMN experience TEXT DEFAULT NULL AFTER formation,
  ADD COLUMN certifications TEXT DEFAULT NULL AFTER experience,
  ADD COLUMN langues VARCHAR(255) DEFAULT NULL AFTER certifications,
  ADD COLUMN centre_interet VARCHAR(500) DEFAULT NULL AFTER langues;
