<?php

// Inclure l'autoloader de Composer
require_once '../../../../lib/phpspreadsheet/vendor/autoload.php';

// Importer les classes nécessaires de PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Créer une nouvelle instance de classeur
$spreadsheet = new Spreadsheet();

// Sélectionner la feuille active
$activeWorksheet = $spreadsheet->getActiveSheet();

// Ajouter des données à quelques cellules
$activeWorksheet->setCellValue('A1', 'Nom');
$activeWorksheet->setCellValue('B1', 'Âge');
$activeWorksheet->setCellValue('A2', 'Jean');
$activeWorksheet->setCellValue('B2', 30);
$activeWorksheet->setCellValue('A3', 'Marie');
$activeWorksheet->setCellValue('B3', 25);

// Créer un écrivain pour sauvegarder le classeur
$writer = new Xlsx($spreadsheet);

// Spécifier le chemin de sauvegarde du fichier Excel
$filePath = 'exemple.xlsx';

// Sauvegarder le classeur dans un fichier Excel
$writer->save($filePath);

// Afficher un message pour confirmer la création du fichier
echo "Le fichier Excel a été créé avec succès.";
