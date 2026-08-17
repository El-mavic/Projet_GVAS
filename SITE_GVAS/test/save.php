<?php

session_start();

require __DIR__ . '/config.php';


/*
|--------------------------------------------------------------------------
| Fonction pour retourner une erreur
|--------------------------------------------------------------------------
*/

function fail($message)
{
    $_SESSION['error'] = $message;

    header('Location: index.php');

    exit;
}


/*
|--------------------------------------------------------------------------
| Vérification de la méthode
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: index.php');

    exit;
}


/*
|--------------------------------------------------------------------------
| Vérification des champs obligatoires
|--------------------------------------------------------------------------
|
| ATTENTION :
| "type_formation" a été remplacé par "formations"
| car l'utilisateur peut maintenant choisir plusieurs formations.
|
|--------------------------------------------------------------------------
*/

$required = [

    'nom',
    'prenoms',
    'sexe',
    'date_naissance',
    'lieu_naissance',
    'nationalite',
    'adresse',
    'telephone',
    'niveau_etudes',
    'date_debut',
    'urgence_nom',
    'urgence_telephone'

];


foreach ($required as $field) {

    if (
        !isset($_POST[$field]) ||
        trim($_POST[$field]) === ''
    ) {

        fail(
            'Veuillez remplir tous les champs obligatoires.'
        );
    }
}


/*
|--------------------------------------------------------------------------
| Vérification des formations
|--------------------------------------------------------------------------
|
| Le formulaire utilise :
|
| name="formations[]"
|
| PHP reçoit donc un tableau :
|
| $_POST['formations']
|
| Exemple :
|
| [
|     "Informatique bureautique",
|     "Anglais",
|     "Logistique"
| ]
|
|--------------------------------------------------------------------------
*/

if (
    !isset($_POST['formations']) ||
    !is_array($_POST['formations']) ||
    count($_POST['formations']) === 0
) {

    fail(
        'Veuillez sélectionner au moins une formation.'
    );
}


/*
|--------------------------------------------------------------------------
| Nettoyage des formations
|--------------------------------------------------------------------------
*/

$formations = [];


foreach ($_POST['formations'] as $formation) {

    $formation = trim($formation);

    /*
     * On ignore les valeurs vides.
     */
    if ($formation === '') {
        continue;
    }

    /*
     * On ajoute la formation au tableau.
     */
    $formations[] = $formation;
}


/*
|--------------------------------------------------------------------------
| Suppression des doublons
|--------------------------------------------------------------------------
*/

$formations = array_unique($formations);


/*
|--------------------------------------------------------------------------
| Vérification finale
|--------------------------------------------------------------------------
*/

if (count($formations) === 0) {

    fail(
        'Veuillez sélectionner au moins une formation.'
    );
}


/*
|--------------------------------------------------------------------------
| Liste des formations autorisées
|--------------------------------------------------------------------------
|
| Cette liste doit correspondre aux formations présentes
| dans ton formulaire.
|
|--------------------------------------------------------------------------
*/

$formationsAutorisees = [

    'Informatique bureautique',

    'Maintenance informatique',

    'Réseaux informatiques',

    'Anglais',

    'Comptabilité',

    'Logistique',

    'QHSE',

    'Comptabilité et gestion',

    'Autre'

];


/*
|--------------------------------------------------------------------------
| Vérification des formations sélectionnées
|--------------------------------------------------------------------------
*/

foreach ($formations as $formation) {

    if (!in_array($formation, $formationsAutorisees, true)) {

        fail(
            'Une des formations sélectionnées n’est pas valide.'
        );
    }
}


/*
|--------------------------------------------------------------------------
| Transformation du tableau en texte
|--------------------------------------------------------------------------
|
| Exemple :
|
| Tableau :
|
| [
|     "Informatique bureautique",
|     "Anglais",
|     "Logistique"
| ]
|
| Devient :
|
| Informatique bureautique, Anglais, Logistique
|
| Cette valeur sera enregistrée dans la colonne
| "type_formation" de la table inscriptions.
|
|--------------------------------------------------------------------------
*/

$typeFormation = implode(', ', $formations);


/*
|--------------------------------------------------------------------------
| Vérification de l'engagement
|--------------------------------------------------------------------------
*/

if (!isset($_POST['engagement'])) {

    fail(
        'Vous devez accepter l’engagement avant de valider.'
    );
}


/*
|--------------------------------------------------------------------------
| Connexion à la base de données
|--------------------------------------------------------------------------
*/

try {

    $pdo = db();


    /*
    |--------------------------------------------------------------------------
    | Génération du matricule
    |--------------------------------------------------------------------------
    */

    $matricule = trim(
        $_POST['matricule'] ?? ''
    );


    /*
     * Si aucun matricule n'a été fourni,
     * nous en générons automatiquement un.
     */
    if ($matricule === '') {

        $matricule =
            'GVAS-' .
            date('Y') .
            '-' .
            strtoupper(
                bin2hex(
                    random_bytes(3)
                )
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Gestion de la photo
    |--------------------------------------------------------------------------
    */

    $photoName = null;


    /*
     * Vérification de la présence d'une photo.
     */
    if (
        isset($_FILES['photo']) &&
        !empty($_FILES['photo']['name'])
    ) {


        /*
        |--------------------------------------------------------------------------
        | Vérification de l'erreur d'upload
        |--------------------------------------------------------------------------
        */

        if (
            $_FILES['photo']['error'] !==
            UPLOAD_ERR_OK
        ) {

            fail(
                'La photo n’a pas pu être téléversée.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Taille maximale : 2 Mo
        |--------------------------------------------------------------------------
        */

        if (
            $_FILES['photo']['size'] >
            2 * 1024 * 1024
        ) {

            fail(
                'La photo dépasse la taille maximale de 2 Mo.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Formats autorisés
        |--------------------------------------------------------------------------
        */

        $allowed = [

            'image/jpeg' => 'jpg',

            'image/png' => 'png',

            'image/webp' => 'webp'

        ];


        /*
        |--------------------------------------------------------------------------
        | Vérification réelle du type MIME
        |--------------------------------------------------------------------------
        */

        $finfo = new finfo(
            FILEINFO_MIME_TYPE
        );


        $mime = $finfo->file(
            $_FILES['photo']['tmp_name']
        );


        /*
        * Vérification du format.
        */
        if (!isset($allowed[$mime])) {

            fail(
                'Format de photo non autorisé. Utilisez JPG, PNG ou WEBP.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Nom de fichier sécurisé
        |--------------------------------------------------------------------------
        */

        $photoName =
            $matricule .
            '_' .
            bin2hex(
                random_bytes(4)
            ) .
            '.' .
            $allowed[$mime];


        /*
        |--------------------------------------------------------------------------
        | Dossier uploads
        |--------------------------------------------------------------------------
        */

        $uploadDir =
            __DIR__ .
            DIRECTORY_SEPARATOR .
            'uploads' .
            DIRECTORY_SEPARATOR;


        /*
        * Création du dossier s'il n'existe pas.
        */
        if (!is_dir($uploadDir)) {

            if (
                !mkdir(
                    $uploadDir,
                    0755,
                    true
                )
            ) {

                fail(
                    'Impossible de créer le dossier uploads.'
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Enregistrement de la photo
        |--------------------------------------------------------------------------
        */

        if (
            !move_uploaded_file(
                $_FILES['photo']['tmp_name'],
                $uploadDir . $photoName
            )
        ) {

            fail(
                'Impossible d’enregistrer la photo.'
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Requête SQL
    |--------------------------------------------------------------------------
    */

    $sql = "

        INSERT INTO inscriptions (

            matricule,

            nom,

            prenoms,

            sexe,

            date_naissance,

            lieu_naissance,

            nationalite,

            adresse,

            telephone,

            niveau_etudes,

            profession,

            type_formation,

            date_debut,

            urgence_nom,

            urgence_telephone,

            photo

        )

        VALUES (

            :matricule,

            :nom,

            :prenoms,

            :sexe,

            :date_naissance,

            :lieu_naissance,

            :nationalite,

            :adresse,

            :telephone,

            :niveau_etudes,

            :profession,

            :type_formation,

            :date_debut,

            :urgence_nom,

            :urgence_telephone,

            :photo

        )

    ";


    /*
    |--------------------------------------------------------------------------
    | Préparation
    |--------------------------------------------------------------------------
    */

    $stmt = $pdo->prepare($sql);


    /*
    |--------------------------------------------------------------------------
    | Exécution
    |--------------------------------------------------------------------------
    */

    $stmt->execute([

        /*
        * Matricule
        */
        ':matricule' =>
            $matricule,


        /*
        * Nom
        */
        ':nom' =>
            trim($_POST['nom']),


        /*
        * Prénoms
        */
        ':prenoms' =>
            trim($_POST['prenoms']),


        /*
        * Sexe
        */
        ':sexe' =>
            $_POST['sexe'],


        /*
        * Date de naissance
        */
        ':date_naissance' =>
            $_POST['date_naissance'],


        /*
        * Lieu de naissance
        */
        ':lieu_naissance' =>
            trim($_POST['lieu_naissance']),


        /*
        * Nationalité
        */
        ':nationalite' =>
            trim($_POST['nationalite']),


        /*
        * Adresse
        */
        ':adresse' =>
            trim($_POST['adresse']),


        /*
        * Téléphone
        */
        ':telephone' =>
            trim($_POST['telephone']),


        /*
        * Niveau d'études
        */
        ':niveau_etudes' =>
            $_POST['niveau_etudes'],


        /*
        * Profession
        */
        ':profession' =>
            trim($_POST['profession'] ?? ''),


        /*
        |--------------------------------------------------------------------------
        | FORMATIONS
        |--------------------------------------------------------------------------
        |
        | C'est ici que nous enregistrons plusieurs formations
        | dans la colonne type_formation.
        |
        | Exemple :
        |
        | Informatique bureautique, Anglais, Logistique
        |
        |--------------------------------------------------------------------------
        */

        ':type_formation' =>
            $typeFormation,


        /*
        * Date de début
        */
        ':date_debut' =>
            $_POST['date_debut'],


        /*
        * Personne à contacter en cas d'urgence
        */
        ':urgence_nom' =>
            trim($_POST['urgence_nom']),


        /*
        * Téléphone urgence
        */
        ':urgence_telephone' =>
            trim($_POST['urgence_telephone']),


        /*
        * Photo
        */
        ':photo' =>
            $photoName

    ]);


    /*
    |--------------------------------------------------------------------------
    | Succès
    |--------------------------------------------------------------------------
    */

    $_SESSION['success'] =
        'Inscription enregistrée avec succès. ' .
        'Matricule : ' .
        $matricule;


    /*
    |--------------------------------------------------------------------------
    | Retour à la page d'accueil
    |--------------------------------------------------------------------------
    */

    header('Location: index.php');

    exit;


} catch (PDOException $e) {


    /*
    |--------------------------------------------------------------------------
    | ERREUR SQL
    |--------------------------------------------------------------------------
    |
    | Affichage temporaire de l'erreur exacte
    | pour faciliter le dépannage.
    |
    |--------------------------------------------------------------------------
    */

    die('

        <div style="
            font-family:Arial;
            margin:40px;
            padding:25px;
            border-radius:12px;
            background:#fff0ee;
            border:1px solid #e0a29a;
            color:#8b1e16;
        ">

            <h2>
                Erreur MySQL
            </h2>

            <p>
                <strong>Message :</strong>
            </p>

            <pre style="
                white-space:pre-wrap;
                background:white;
                padding:15px;
                border-radius:8px;
            ">' .

        htmlspecialchars(
            $e->getMessage()
        )

        . '</pre>

        </div>

    ');
}