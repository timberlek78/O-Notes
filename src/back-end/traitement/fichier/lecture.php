<?php
// Inclure l'autoloader de Composer
require '../../../../lib/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Charger le fichier Excel
$spreadsheet = IOFactory::load('exemple.xlsx');

// Sélectionner la première feuille du classeur
$worksheet = $spreadsheet->getActiveSheet();

// Récupérer les données de la feuille et les stocker dans un tableau
$data = $worksheet->toArray();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Données de l'Excel</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Données de l'Excel</h2>

<table>
    <tr>
        <?php
        // Afficher les en-têtes de colonnes
        foreach ($data[0] as $header) {
            echo "<th>$header</th>";
        }
        ?>
    </tr>
    <?php
    // Afficher les données dans les lignes du tableau HTML
    for ($i = 1; $i < count($data); $i++) {
        echo "<tr>";
        foreach ($data[$i] as $cell) {
            echo "<td>$cell</td>";
        }
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
