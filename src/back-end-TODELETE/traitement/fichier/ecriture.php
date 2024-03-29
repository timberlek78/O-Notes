<?php

// Inclure l'autoloader de Composer
require_once '../../../../lib/phpspreadsheet/vendor/autoload.php';

// Importer les classes nécessaires de PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function uploadFile($file)
{
    // Vérifier si le fichier a été correctement uploadé
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Récupérer le chemin temporaire du fichier
        $tmpFilePath = $file['tmp_name'];

        // Générer un nouveau nom de fichier unique
        $newFileName = uniqid() . '_' . $file['name'];

        // Définir le chemin de destination sur votre serveur
        $destinationPath = '../../data/tmp/' . $newFileName;

        // Déplacer le fichier vers le chemin de destination
        if (move_uploaded_file($tmpFilePath, $destinationPath)) {
            // Charger le fichier Excel
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($destinationPath);
            $spreadsheet = $reader->load($destinationPath);

            // Récupérer la première feuille du classeur
            $worksheet = $spreadsheet->getActiveSheet();

            // Récupérer les données de la feuille et les stocker dans un tableau
            $data = $worksheet->toArray();

			$file['tmp_name'] = $destinationPath;

            // Retourner les données
            return $file;
        } else {
            // Afficher un message d'erreur si le fichier n'a pas pu être déplacé
            return "Erreur lors du déplacement du fichier.";
        }
    } else {
        // Afficher un message d'erreur si le fichier n'a pas été correctement uploadé
        return "Erreur lors de l'upload du fichier.";
    }
}


/*
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
*/