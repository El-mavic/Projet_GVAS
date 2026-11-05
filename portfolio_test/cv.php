<?php
/**
 * Affiche le CV PDF d'un profil public.
 * URL : cv.php?id=IDENTIFIANT_DU_PROFIL
 */
require_once __DIR__ . '/config.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    http_response_code(400);
    exit('Identifiant de profil invalide.');
}

$stmt = $pdo->prepare('SELECT id, cv_path, public, payment_status FROM users WHERE id = ? LIMIT 1');
$stmt->execute([$id]);
$user = $stmt->fetch();

if (!$user || empty($user['cv_path'])) {
    http_response_code(404);
    exit('Aucun CV n’est enregistré pour ce profil.');
}
if (((int) $user['public'] !== 1 || ($user['payment_status'] ?? 'unpaid') !== 'paid') && (int) ($_SESSION['user_id'] ?? 0) !== (int) $user['id']) {
    http_response_code(403);
    exit('Ce portfolio est privé.');
}

// Les chemins enregistrés en base peuvent être "uploads/cv/fichier.pdf"
// ou simplement "fichier.pdf". Dans les deux cas, le fichier reste dans uploads/cv.
$storedPath = str_replace('\\', '/', trim((string) $user['cv_path']));
$fileName = basename($storedPath);
$cvDirectory = __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'cv';
$filePath = $cvDirectory . DIRECTORY_SEPARATOR . $fileName;

if (!is_file($filePath) || !is_readable($filePath)) {
    // Corrige le cas d'un nom généré qui diffère d'un seul caractère (faute de copie).
    // On ne fait cette récupération que pour des noms aléatoires hexadécimaux .pdf
    // et seulement si une correspondance unique à une distance d'un caractère existe.
    $storedStem = strtolower(pathinfo($fileName, PATHINFO_FILENAME));
    $storedExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if ($storedExtension === 'pdf' && preg_match('/^[a-f0-9]{31,32}$/', $storedStem) && is_dir($cvDirectory)) {
        $candidates = glob($cvDirectory . DIRECTORY_SEPARATOR . '*.pdf') ?: [];
        $matches = [];
        foreach ($candidates as $candidate) {
            $candidateStem = strtolower(pathinfo($candidate, PATHINFO_FILENAME));
            if (!preg_match('/^[a-f0-9]{32}$/', $candidateStem)) {
                continue;
            }
            if (levenshtein($storedStem, $candidateStem) <= 1) {
                $matches[] = $candidate;
            }
        }
        if (count($matches) === 1) {
            $filePath = $matches[0];
        }
    }
}

if (!is_file($filePath) || !is_readable($filePath)) {
    http_response_code(404);
    exit('Le fichier PDF est introuvable. Vérifiez le nom enregistré dans la base de données et le dossier uploads/cv/.');
}
if (strtolower(pathinfo($filePath, PATHINFO_EXTENSION)) !== 'pdf') {
    http_response_code(415);
    exit('Le CV enregistré n’est pas un fichier PDF.');
}

// Ne rien envoyer avant les en-têtes PDF.
while (ob_get_level() > 0) {
    ob_end_clean();
}

$size = filesize($filePath);
if ($size === false) {
    http_response_code(500);
    exit('Impossible de lire le fichier PDF.');
}

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="CV-' . $id . '.pdf"');
header('Content-Length: ' . $size);
header('Content-Transfer-Encoding: binary');
header('X-Content-Type-Options: nosniff');
header('Cache-Control: private, no-store, no-cache, must-revalidate');
header('Pragma: no-cache');

$handle = fopen($filePath, 'rb');
if ($handle === false) {
    http_response_code(500);
    exit('Impossible d’ouvrir le fichier PDF.');
}
fpassthru($handle);
fclose($handle);
exit;
