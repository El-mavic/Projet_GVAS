<?php

require __DIR__ . '/admin_auth.php';
require __DIR__ . '/config.php';
require __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$pdo = db();

$q = trim($_GET['q'] ?? '');
$formation = trim($_GET['formation'] ?? '');

$where = [];
$params = [];

if ($q !== '') {
    $where[] = "(nom LIKE :q 
        OR prenoms LIKE :q 
        OR matricule LIKE :q 
        OR telephone LIKE :q)";

    $params[':q'] = "%$q%";
}

if ($formation !== '') {
    $where[] = "type_formation = :formation";
    $params[':formation'] = $formation;
}

$sql = "
    SELECT 
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
        created_at
    FROM inscriptions
";

if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$sql .= " ORDER BY created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);


// ================================
// CRÉATION DU FICHIER EXCEL
// ================================

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();

$sheet->setTitle('Inscriptions GVAS');


// ================================
// EN-TÊTES
// ================================

$headers = [
    'Matricule',
    'Nom',
    'Prénoms',
    'Sexe',
    'Date naissance',
    'Lieu naissance',
    'Nationalité',
    'Adresse',
    'Téléphone',
    'Niveau',
    'Profession',
    'Formation',
    'Date début',
    'Contact urgence',
    'Téléphone urgence',
    'Date inscription'
];

$sheet->fromArray($headers, null, 'A1');


// ================================
// STYLE DES EN-TÊTES
// ================================

$sheet->getStyle('A1:P1')->applyFromArray([
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF']
    ],

    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => '1F4E78'
        ]
    ],

    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ]
]);


// ================================
// DONNÉES
// ================================

$row = 2;

while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $sheet->fromArray([
        $data['matricule'],
        $data['nom'],
        $data['prenoms'],
        $data['sexe'],
        $data['date_naissance'],
        $data['lieu_naissance'],
        $data['nationalite'],
        $data['adresse'],
        $data['telephone'],
        $data['niveau_etudes'],
        $data['profession'],
        $data['type_formation'],
        $data['date_debut'],
        $data['urgence_nom'],
        $data['urgence_telephone'],
        $data['created_at']
    ], null, 'A' . $row);

    $row++;
}


// ================================
// MISE EN FORME
// ================================

// Ajustement automatique des colonnes
foreach (range('A', 'P') as $column) {
    $sheet->getColumnDimension($column)->setAutoSize(true);
}

// Figer la première ligne
$sheet->freezePane('A2');

// Filtre automatique
if ($row > 2) {
    $sheet->setAutoFilter('A1:P' . ($row - 1));
}

// Hauteur de l'en-tête
$sheet->getRowDimension(1)->setRowHeight(25);


// ================================
// TÉLÉCHARGEMENT
// ================================

$filename = 'inscriptions_gvas_' . date('Y-m-d') . '.xlsx';

header(
    'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
);

header(
    'Content-Disposition: attachment; filename="' . $filename . '"'
);

header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);

$writer->save('php://output');

exit;
