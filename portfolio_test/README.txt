MON PORTFOLIO — Version enrichie CV, photos et détails de profil

FONCTIONNALITÉS
- Recherche des profils publics par nom, métier, compétences ou présentation, filtre métier et pagination.
- Inscription et connexion sécurisées (password_hash/password_verify).
- Ajout du CV à l'inscription puis possibilité de le remplacer dans l'espace personnel.
- Téléversement d'une photo de profil et d'une photo de couverture.
- Portfolio public avec bouton « Consulter le CV », photo de profil, couverture et coordonnées.
- Renseignements complémentaires : téléphone, localisation, formation, expérience, certifications, langues et centres d'intérêt.
- Modification des informations et contrôle de visibilité publique.
- Interface responsive ordinateur/tablette/téléphone.
- Requêtes PDO préparées, échappement HTML, jeton CSRF sur les formulaires et vérification des types de fichiers.

INSTALLATION SUR UNE NOUVELLE BASE
1. Décompressez le dossier portfolio_test dans htdocs (XAMPP) ou dans le répertoire web de votre hébergement.
2. Importez database.sql dans phpMyAdmin. Le script crée port_folio_db et les tables users et projets.
3. Adaptez config.php aux identifiants MySQL de votre environnement.
4. Vérifiez que les dossiers uploads/cv et uploads/images sont accessibles en écriture par PHP.
5. Ouvrez http://localhost/portfolio_test/ puis créez un compte.

MISE À JOUR D'UNE BASE EXISTANTE
1. Faites d'abord une sauvegarde de votre base de données.
2. Dans phpMyAdmin, sélectionnez la base actuellement utilisée par ce projet.
3. Importez/exécutez migration_profils.sql UNE SEULE FOIS. Ce script ajoute les colonnes requises sans supprimer les comptes existants.
4. Remplacez les fichiers du projet par ceux de cette archive, en gardant votre config.php configuré pour la bonne base.
5. Vérifiez les permissions des dossiers uploads/cv et uploads/images.

TÉLÉVERSEMENTS
- CV acceptés : PDF, DOC, DOCX, 5 Mo maximum.
- Images acceptées : JPG/JPEG, PNG, WEBP, 3 Mo maximum.
- Les fichiers reçoivent un nom aléatoire. Le dossier uploads interdit l'indexation et bloque les extensions de script courantes.
- Le CV est consultable depuis la carte du profil (si un CV existe) et depuis la page du portfolio.

NOTES
- Les détails du portfolio sont publics lorsque le membre coche « Mon portfolio est visible dans les recherches ».
- Les CV sont accessibles par URL aux personnes ayant accès au lien. Ne téléversez pas de documents contenant des données confidentielles.
- La page affiche les projets existants dans la table projets. L'interface d'ajout de projets reste une évolution séparée.
- En production, utilisez HTTPS, configurez les sauvegardes et une politique de confidentialité.

MISE À JOUR : INSCRIPTION SIMPLIFIÉE ET RÉALISATIONS
- register.php ne demande désormais que le nom complet, l'e-mail, le téléphone et le mot de passe avec confirmation.
- Après inscription, le membre est redirigé vers dashboard.php pour ajouter son métier, ses compétences, sa présentation, sa photo de profil, sa couverture, son CV et ses autres informations.
- Dans le même tableau de bord, la section « Mes réalisations et projets » permet d'ajouter un titre, une description, une image et un lien, puis de supprimer ses propres projets.
- profil.php affiche les réalisations publiées sur le portfolio public.

IMPORTANT : exécutez migration_projets.sql dans la base existante si la table `projets` n'existe pas encore. Le script utilise CREATE TABLE IF NOT EXISTS et ne supprime aucune donnée. Gardez une sauvegarde de la base avant toute migration.


CORRECTION LECTURE DU CV
- Tous les boutons « Consulter le CV » passent désormais par cv.php?id=ID.
- cv.php envoie le PDF sans afficher de texte avant les en-têtes HTTP.
- Si le nom aléatoire enregistré en base comporte une faute d’un seul caractère et qu’une correspondance unique existe, le fichier est retrouvé automatiquement.
- Si le CV ne s’ouvre toujours pas dans le navigateur, essayer le téléchargement ou vérifier le lecteur PDF du navigateur.


MISE À JOUR : PUBLICATION APRÈS PAIEMENT YABETOO PAY
- À l'inscription, le compte reste privé et son paiement est défini à « unpaid ».
- L'accueil et la page publique n'affichent que les profils avec public = 1 ET payment_status = 'paid'.
- Quand l'utilisateur paie, le serveur appelle l'API Yabetoo Pay. Le portfolio est publié automatiquement uniquement si la réponse de confirmation indique status = 'succeeded' et captured = true. Le retour du navigateur seul ne valide jamais le paiement.
- Le paiement.php accepte MTN Mobile Money et Airtel Money pour le Congo-Brazzaville. Le prix par défaut est 1 000 FCFA et peut être changé dans config/yabetoo.php (publication_amount) ou avec YABETOO_PUBLICATION_AMOUNT.
- CONFIGURATION OBLIGATOIRE : ouvrez config/yabetoo.php et remplacez REMPLACER_PAR_VOTRE_CLE_SECRETE par la clé secrète de votre compte marchand Yabetoo Pay. Gardez le mode « sandbox » pour les tests. Passez à « production » seulement lorsque votre compte et votre clé de production sont prêts. Ne mettez jamais la clé dans le JavaScript et ne la partagez pas.
- L'extension PHP cURL doit être activée dans WampServer. Les erreurs détaillées de l'API sont consignées dans le journal PHP ; la clé secrète n'est jamais affichée à l'utilisateur.
- Documentation officielle : https://docs.yabetoopay.com/en/payments/api/create et https://docs.yabetoopay.com/en/payments/api/confirm.
- Pour une base existante, exécutez migration_yabetoo_pay.sql une seule fois après sauvegarde afin de mettre à jour le nom du fournisseur dans l'historique. Si les colonnes et la table de paiement n'existent pas encore, appliquez d'abord migration_publication_paiement.sql selon les instructions de ce fichier.

ADMINISTRATEUR
- Un bouton « Admin » est disponible dans la barre de navigation de l’accueil.
- Accès initial après installation de la table administrateur : identifiant `admin`, mot de passe temporaire `Admin@2026!`.
- Changez immédiatement ce mot de passe dans la section « Sécurité du compte » du dashboard. Utilisez un mot de passe unique d’au moins 12 caractères.
- Pour une base déjà existante, sauvegardez la base puis exécutez `migration_admin.sql` dans phpMyAdmin.
- Le dashboard permet de suivre les comptes, les profils publiés/privés, les statuts de paiement et les transactions récentes, de rechercher/filtrer les utilisateurs, et de publier/retirer un portfolio. Il ne permet pas de déclarer manuellement un paiement comme réussi : cela doit venir de la confirmation serveur de Yabetoo Pay.
- Les transactions sont affichées si la table `publication_payments` est présente. Pour l’installer sur une base existante, appliquez la migration de paiement appropriée une seule fois après sauvegarde.

