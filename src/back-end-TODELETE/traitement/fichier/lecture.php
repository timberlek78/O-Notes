<?php
// Inclure l'autoloader de Composer
require '../../../../lib/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

function loadFile($file)
{
    // Vérifier si le fichier a été correctement uploadé
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Charger le fichier Excel
        $reader = IOFactory::createReaderForFile($file['tmp_name']);
        $spreadsheet = $reader->load($file['tmp_name']);

        // Sélectionner la première feuille du classeur
        $worksheet = $spreadsheet->getActiveSheet();

        // Récupérer les données de la feuille et les stocker dans un tableau
        $data = $worksheet->toArray();

        return $data;
    } else {
        // Afficher un message d'erreur si le fichier n'a pas été correctement uploadé
        return "Erreur lors de l'upload du fichier.";
    }
}

function displayData($data)
{
    // Afficher les données dans un tableau HTML
    echo "<table>";

    // Afficher les en-têtes de colonnes
    echo "<tr>";
    foreach ($data[0] as $header) {
        echo "<th>$header</th>";
    }
    echo "</tr>";

    // Afficher les données dans les lignes du tableau HTML
    for ($i = 1; $i < count($data); $i++) {
        echo "<tr>";
        foreach ($data[$i] as $cell) {
            echo "<td>$cell</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}
?>
