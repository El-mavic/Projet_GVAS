<?php
require __DIR__ . '/admin_auth.php';
require __DIR__ . '/config.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: dashboard.php');
    exit;
}

$pdo = db();
$stmt = $pdo->prepare("SELECT * FROM inscriptions WHERE id = ?");
$stmt->execute([$id]);
$r = $stmt->fetch();
if (!$r) {
    http_response_code(404);
    exit('Inscription introuvable.');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Fiche <?= htmlspecialchars($r['matricule']) ?> | GVAS</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <main class="admin-wrap">
        <div class="detail-actions no-print">
            <a class="btn light" href="dashboard.php">← Retour</a>
            <a class="btn primary" href="edit.php?id=<?= $id ?>">Modifier</a>
            <button class="btn export" onclick="window.print()">Imprimer / PDF</button>
        </div>

        <!-- =========================================================
     FICHE D'INSCRIPTION
     ========================================================= -->

        <section class="print-sheet">


            <!-- =====================================================
         LOGO GVAS EN FILIGRANE
         ===================================================== -->

            <div class="watermark">

                <img
                    src="Images/logo.png"
                    alt="Logo GVAS">

            </div>


            <!-- =====================================================
         EN-TÊTE
         ===================================================== -->

            <header class="sheet-head">

                <div class="sheet-title">

                    <p>
                        FICHE D'INSCRIPTION
                    </p>


                    <h1>
                        PROGRAMME VACANCES UTILES
                    </h1>


                    <span>

                        Matricule :

                        <strong>
                            <?= htmlspecialchars($r['matricule']) ?>
                        </strong>

                    </span>

                </div>
                <!-- =================================================
             LOGO / IDENTITÉ GVAS
             ================================================= -->



                <!-- =================================================
             PHOTO DE L'APPRENANT
             ================================================= -->

                <?php if (
                    !empty($r['photo']) &&
                    is_file(__DIR__ . '/uploads/' . $r['photo'])
                ): ?>

                    <img
                        class="profile-photo"
                        src="uploads/<?= htmlspecialchars($r['photo']) ?>"
                        alt="Photo de l'apprenant">

                <?php endif; ?>


            </header>


            <!-- =====================================================
         TITRE DE LA FICHE
         ===================================================== -->





            <!-- =====================================================
         PRÉPARATION DES FORMATIONS
         ===================================================== -->

            <?php

            /*
    |--------------------------------------------------------------------------
    | Récupération des formations
    |--------------------------------------------------------------------------
    |
    | Exemple de valeur enregistrée dans la base :
    |
    | Informatique bureautique, Anglais, Logistique
    |
    | Nous transformons cette chaîne en tableau.
    |
    |--------------------------------------------------------------------------
    */

            $formations = [];


            if (!empty($r['type_formation'])) {

                /*
        * Séparation des formations par virgule.
        */
                $formations = explode(
                    ',',
                    $r['type_formation']
                );


                /*
        * Suppression des espaces inutiles.
        */
                $formations = array_map(
                    'trim',
                    $formations
                );


                /*
        * Suppression des valeurs vides.
        */
                $formations = array_filter(
                    $formations,
                    function ($formation) {
                        return $formation !== '';
                    }
                );
            }


            /*
    |--------------------------------------------------------------------------
    | Préparation des sections
    |--------------------------------------------------------------------------
    */

            $sections = [


                /* -------------------------------------------------
           INFORMATIONS PERSONNELLES
           ------------------------------------------------- */

                'Informations personnelles' => [

                    'Nom(s)' =>
                    $r['nom'],

                    'Prénom(s)' =>
                    $r['prenoms'],

                    'Sexe' =>
                    $r['sexe'],

                    'Date de naissance' =>
                    date(
                        'd/m/Y',
                        strtotime(
                            $r['date_naissance']
                        )
                    ),

                    'Lieu de naissance' =>
                    $r['lieu_naissance'],

                    'Nationalité' =>
                    $r['nationalite']

                ],



                /* -------------------------------------------------
           COORDONNÉES
           ------------------------------------------------- */

                'Coordonnées' => [

                    'Adresse' =>
                    $r['adresse'],

                    'Téléphone' =>
                    $r['telephone']

                ],



                /* -------------------------------------------------
           SITUATION ACADÉMIQUE / PROFESSIONNELLE
           ------------------------------------------------- */

                'Situation académique / professionnelle' => [

                    'Niveau d’études' =>
                    $r['niveau_etudes'],

                    'Profession' =>
                    !empty($r['profession'])
                        ? $r['profession']
                        : '—'

                ],



                /* -------------------------------------------------
           PERSONNE À CONTACTER EN CAS D'URGENCE
           ------------------------------------------------- */

                'Personne à contacter en cas d’urgence' => [

                    'Nom(s) et prénom(s)' =>
                    $r['urgence_nom'],

                    'Téléphone' =>
                    $r['urgence_telephone']

                ]

            ];



            /* =====================================================
       AFFICHAGE DES SECTIONS
       ===================================================== */

            foreach (
                $sections as $title => $items
            ):

            ?>

                <!-- =================================================
             UNE SECTION
             ================================================= -->

                <div class="detail-section">


                    <!-- Titre de la section -->

                    <h2>

                        <?= htmlspecialchars($title) ?>

                    </h2>


                    <!-- Grille des informations -->

                    <div class="detail-grid">


                        <?php foreach (
                            $items as $label => $value
                        ): ?>

                            <div>


                                <!-- Nom du champ -->

                                <small>

                                    <?= htmlspecialchars($label) ?>

                                </small>


                                <!-- Valeur -->

                                <strong>

                                    <?= htmlspecialchars($value) ?>

                                </strong>


                            </div>

                        <?php endforeach; ?>


                    </div>

                </div>

            <?php endforeach; ?>



            <!-- =====================================================
         SECTION FORMATIONS
         ===================================================== -->

            <div class="detail-section">


                <!-- Titre -->

                <h2>
                    Formations choisies
                </h2>


                <div class="detail-grid">


                    <!-- =================================================
                 LISTE DES FORMATIONS
                 ================================================= -->

                    <div class="formation-display">

                        <small>
                            Formations
                        </small>


                        <?php if (!empty($formations)): ?>

                            <div class="formation-values">

                                <?php foreach (
                                    $formations as $formation
                                ): ?>

                                    <strong class="formation-item">

                                        <?= htmlspecialchars($formation) ?>

                                    </strong>

                                <?php endforeach; ?>

                            </div>

                        <?php else: ?>

                            <strong>
                                —
                            </strong>

                        <?php endif; ?>

                    </div>



                    <!-- =================================================
                 DATE DE DÉBUT
                 ================================================= -->

                    <div>

                        <small>
                            Date de début
                        </small>


                        <strong>

                            <?= date(
                                'd/m/Y',
                                strtotime(
                                    $r['date_debut']
                                )
                            ) ?>

                        </strong>

                    </div>


                </div>

            </div>



            <!-- =====================================================
         ENGAGEMENT DE L'APPRENANT
         ===================================================== -->

            <div class="engagement">


                <h2>
                    Engagement de l’apprenant
                </h2>


                <p>

                    Je certifie exacts les renseignements fournis dans
                    cette fiche et m’engage à respecter le règlement
                    intérieur de GVAS.

                </p>


            </div>



            <!-- =====================================================
         SIGNATURES
         ===================================================== -->

            <div class="signatures">


                <span>
                    Signature de l’apprenant
                </span>


                <span>
                    Signature et cachet de GVAS
                </span>


            </div>


        </section>


        <!-- =========================================================
     FIN DE LA FICHE
     ========================================================= -->

    </main>

    </div>

</body>

</html>