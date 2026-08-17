<?php
session_start();
$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programme Vacances Utiles | GVAS</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <header class="topbar">
        <div class="brand">
            <div class="brand-logo">GVAS </div>

            <div>
                <p class="groupe"> "Groupement des Volontaires pour l’Action Sociale" </p>
            </div>

        </div>
        <div class="contact">
            <span> <i class="fa-solid fa-phone"> </i> 06 620 89 94 / 05 344 40 20</span>
            <span> <i class="fa-solid fa-map-marker-alt"> </i> Pointe-Noire, Congo</span>
            <a href="login.php" class="icon"> <i class="fas fa-user-shield"></i></a>

        </div>
    </header>

    <main class="page">
        <section class="hero">
            <div>
                <p class="eyebrow">INSCRIPTION EN LIGNE</p>
                <h1>Programme Vacances Utiles</h1>
                <p>Remplissez soigneusement ce formulaire pour enregistrer votre inscription.</p>
            </div>
            <div class="hero-badge">2026</div>
        </section>

        <?php if ($success): ?>
            <div class="alert success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="save.php" method="POST" enctype="multipart/form-data" id="registrationForm">
            <section class="card">
                <div class="section-title">
                    <span class="number">01</span>
                    <div>
                        <h2>Informations personnelles</h2>
                        <p>Identité et informations de naissance</p>
                    </div>
                </div>

                <div class="grid two">
                    <label class="field">
                        <span>Nom(s) <b>*</b></span>
                        <input type="text" name="nom" required maxlength="100" placeholder="Ex. BAKALA">
                    </label>
                    <label class="field">
                        <span>Prénom(s) <b>*</b></span>
                        <input type="text" name="prenoms" required maxlength="150" placeholder="Ex. El-Mavic">
                    </label>
                </div>

                <div class="grid three">
                    <div class="field">
                        <span>Sexe <b>*</b></span>
                        <div class="radio-group">
                            <label><input type="radio" name="sexe" value="Masculin" required> Masculin</label>
                            <label><input type="radio" name="sexe" value="Féminin"> Féminin</label>
                        </div>
                    </div>
                    <label class="field">
                        <span>Date de naissance <b>*</b></span>
                        <input type="date" name="date_naissance" required>
                    </label>
                    <label class="field">
                        <span>Lieu de naissance <b>*</b></span>
                        <input type="text" name="lieu_naissance" required maxlength="150" placeholder="Ex. Pointe-Noire">
                    </label>
                </div>

                <div class="grid two">
                    <label class="field">
                        <span>Nationalité <b>*</b></span>
                        <input type="text" name="nationalite" required maxlength="80" value="Congolaise">
                    </label>
                    <label class="field">
                        <span>Numéro matricule</span>
                        <input type="text" name="matricule" maxlength="50" placeholder="Laisser vide pour génération automatique">
                        <small>Un matricule sera généré automatiquement s’il est laissé vide.</small>
                    </label>
                </div>
            </section>

            <section class="card">
                <div class="section-title">
                    <span class="number">02</span>
                    <div>
                        <h2>Coordonnées</h2>
                        <p>Informations permettant de vous contacter</p>
                    </div>
                </div>

                <div class="grid two">
                    <label class="field">
                        <span>Adresse <b>*</b></span>
                        <input type="text" name="adresse" required maxlength="255" placeholder="Quartier, arrondissement, ville...">
                    </label>
                    <label class="field">
                        <span>Téléphone <b>*</b></span>
                        <input type="tel" name="telephone" required maxlength="30" placeholder="06 xxx xx xx">
                    </label>
                </div>
            </section>

            <section class="card">
                <div class="section-title">
                    <span class="number">03</span>
                    <div>
                        <h2>Situation académique / professionnelle</h2>
                        <p>Votre niveau d’études et votre activité actuelle</p>
                    </div>
                </div>

                <div class="grid two">
                    <label class="field">
                        <span>Niveau d’études <b>*</b></span>
                        <select name="niveau_etudes" required>
                            <option value="">-- Sélectionner --</option>
                            <option>Primaire</option>
                            <option>Collège</option>
                            <option>Lycée</option>
                            <option>Baccalauréat</option>
                            <option>Licence</option>
                            <option>Master</option>
                            <option>Doctorat</option>
                            <option>Formation professionnelle</option>
                            <option>Autre</option>
                        </select>
                    </label>
                    <label class="field">
                        <span>Profession</span>
                        <input type="text" name="profession" maxlength="120" placeholder="Élève, étudiant(e), salarié(e), etc.">
                    </label>
                </div>
            </section>

            <!-- =========================================================
     SECTION 04 : FORMATIONS CHOISIES
     L'utilisateur peut choisir UNE ou PLUSIEURS formations.
     ========================================================= -->

            <section class="card">

                <div class="section-title">

                    <span class="number">04</span>

                    <div>
                        <h2>Formations choisies</h2>

                        <p>
                            Vous pouvez sélectionner plusieurs formations
                            si vous le souhaitez.
                        </p>
                    </div>

                </div>


                <!-- =====================================================
         LISTE DES FORMATIONS
         ===================================================== -->

                <div class="field">

                    <span>
                        Formations <b>*</b>
                    </span>


                    <div class="formation-list">

                        <!-- Informatique bureautique -->
                        <label class="formation-option">

                            <input
                                type="checkbox"
                                name="formations[]"
                                value="Informatique bureautique">

                            <span>
                                Informatique bureautique
                            </span>

                        </label>


                        <!-- Maintenance informatique -->
                        <label class="formation-option">

                            <input
                                type="checkbox"
                                name="formations[]"
                                value="Maintenance informatique">

                            <span>
                                Maintenance informatique
                            </span>

                        </label>


                        <!-- Réseaux informatiques -->
                        <label class="formation-option">

                            <input
                                type="checkbox"
                                name="formations[]"
                                value="Réseaux informatiques">

                            <span>
                                Réseaux informatiques
                            </span>

                        </label>


                        <!-- Anglais -->
                        <label class="formation-option">

                            <input
                                type="checkbox"
                                name="formations[]"
                                value="Anglais">

                            <span>
                                Anglais
                            </span>

                        </label>


                        <!-- Comptabilité -->
                        <label class="formation-option">

                            <input
                                type="checkbox"
                                name="formations[]"
                                value="Comptabilité">

                            <span>
                                Comptabilité
                            </span>

                        </label>


                        <!-- Logistique -->
                        <label class="formation-option">

                            <input
                                type="checkbox"
                                name="formations[]"
                                value="Logistique">

                            <span>
                                Logistique
                            </span>

                        </label>


                        <!-- QHSE -->
                        <label class="formation-option">

                            <input
                                type="checkbox"
                                name="formations[]"
                                value="QHSE">

                            <span>
                                QHSE
                            </span>

                        </label>


                        <label class="formation-option">

                            <input
                                type="checkbox"
                                name="formations[]"
                                value="Comptabilité et gestion">

                            <span>
                                Comptabilité et gestion
                            </span>

                        </label>

                        <!-- Autre -->
                        <label class="formation-option">

                            <input
                                type="checkbox"
                                name="formations[]"
                                value="Autre">

                            <span>
                                Autre
                            </span>

                        </label>
                        <label class="field">

                            <span>
                                Date de début <b>*</b>
                            </span>

                            <input
                                type="date"
                                name="date_debut"
                                required>

                        </label>

                    </div>


                    <!-- Message affiché si aucune formation n'est sélectionnée -->
                    <small id="formationError" class="formation-error">
                        Veuillez sélectionner au moins une formation.
                    </small>

                </div>


            </section>
            <section class="card">
                <div class="section-title">
                    <span class="number">05</span>
                    <div>
                        <h2>Personne à contacter en cas d’urgence</h2>
                        <p>Un proche pouvant être joint rapidement</p>
                    </div>
                </div>

                <div class="grid two">
                    <label class="field">
                        <span>Nom(s) et prénom(s) <b>*</b></span>
                        <input type="text" name="urgence_nom" required maxlength="180" placeholder="Nom complet">
                    </label>
                    <label class="field">
                        <span>Téléphone <b>*</b></span>
                        <input type="tel" name="urgence_telephone" required maxlength="30" placeholder="06 xxx xx xx">
                    </label>
                </div>
            </section>

            <section class="card">
                <div class="section-title">
                    <span class="number">06</span>
                    <div>
                        <h2>Photo et engagement</h2>
                        <p>Dernières informations avant validation</p>
                    </div>
                </div>

                <div class="photo-upload">
                    <div class="photo-preview" id="photoPreview">
                        <span>PHOTO</span>
                    </div>
                    <div>
                        <label class="upload-button">
                            Choisir une photo
                            <input type="file" name="photo" id="photo" accept="image/jpeg,image/png,image/webp">
                        </label>
                        <p class="hint">JPG, PNG ou WEBP — 2 Mo maximum.</p>
                    </div>
                </div>

                <label class="agreement">
                    <input type="checkbox" name="engagement" value="1" required>
                    <span>Je certifie exacts les renseignements fournis dans cette fiche et m’engage à respecter le règlement intérieur de GVAS.</span>
                </label>

                <div class="signature-date">
                    Fait à Pointe-Noire, le <strong><?= date('d/m/Y') ?></strong>
                </div>

                <div class="actions">
                    <button type="reset" class="btn secondary">Réinitialiser</button>
                    <button type="submit" class="btn primary">Enregistrer l’inscription</button>
                </div>
            </section>
        </form>

        <footer>
            <strong> Groupement des Volontaires pour l’Action Sociale</strong>
            <span>Quartier Mpaka, Secteur X-OR Terminus, en diagonale de l'école privée VAN MAMIGUI — Pointe-Noire / République du Congo</span>
        </footer>
    </main>

    <script>
        const photo = document.getElementById('photo');
        const preview = document.getElementById('photoPreview');

        photo.addEventListener('change', () => {
            const file = photo.files[0];
            if (!file) {
                preview.innerHTML = '<span>PHOTO</span>';
                return;
            }
            if (file.size > 2 * 1024 * 1024) {
                alert('La photo ne doit pas dépasser 2 Mo.');
                photo.value = '';
                preview.innerHTML = '<span>PHOTO</span>';
                return;
            }
            const reader = new FileReader();
            reader.onload = e => {
                preview.innerHTML = `<img src="${e.target.result}" alt="Aperçu de la photo">`;
            };
            reader.readAsDataURL(file);
        });
    </script>
</body>

</html>