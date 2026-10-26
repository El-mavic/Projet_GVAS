<?php
/** Fonctions de téléversement sécurisées pour les CV et les images du portfolio. */
function portfolioUpload(string $field, string $kind, ?string $oldPath = null): ?string {
    if (!isset($_FILES[$field]) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) return $oldPath;
    $file = $_FILES[$field];
    if ($file['error'] !== UPLOAD_ERR_OK) throw new RuntimeException('Le fichier « ' . $field . ' » n’a pas pu être envoyé.');
    if (!is_uploaded_file($file['tmp_name'])) throw new RuntimeException('Fichier envoyé invalide.');

    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if ($kind === 'cv') {
        if ($file['size'] > 5 * 1024 * 1024) throw new RuntimeException('Le CV ne doit pas dépasser 5 Mo.');
        $allowed = ['pdf' => ['application/pdf'], 'doc' => ['application/msword', 'application/octet-stream'], 'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/octet-stream']];
        if (!isset($allowed[$extension])) throw new RuntimeException('Le CV doit être au format PDF, DOC ou DOCX.');
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']);
        if (!in_array($mime, $allowed[$extension], true)) throw new RuntimeException('Le contenu du CV ne correspond pas à son extension.');
        $folder = __DIR__ . '/uploads/cv';
        $relative = 'uploads/cv/';
    } else {
        if ($file['size'] > 3 * 1024 * 1024) throw new RuntimeException('Chaque image ne doit pas dépasser 3 Mo.');
        $allowed = ['jpg' => ['image/jpeg'], 'jpeg' => ['image/jpeg'], 'png' => ['image/png'], 'webp' => ['image/webp']];
        if (!isset($allowed[$extension])) throw new RuntimeException('Les images doivent être au format JPG, PNG ou WEBP.');
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']);
        if (!in_array($mime, $allowed[$extension], true) || @getimagesize($file['tmp_name']) === false) throw new RuntimeException('Le fichier envoyé n’est pas une image valide.');
        $folder = __DIR__ . '/uploads/images';
        $relative = 'uploads/images/';
    }
    if (!is_dir($folder) && !mkdir($folder, 0755, true) && !is_dir($folder)) throw new RuntimeException('Impossible de préparer le dossier de téléversement.');
    $filename = bin2hex(random_bytes(16)) . '.' . $extension;
    if (!move_uploaded_file($file['tmp_name'], $folder . '/' . $filename)) throw new RuntimeException('Impossible d’enregistrer le fichier envoyé.');
    return $relative . $filename;
}
