<?php

include '../../ONotes.php';
include '../../exportation/pdf/ExportEtudiantToPDF.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$onote = new ONote();

$creationPdf = new ExportEtudiantToPDF($onote->getEnsEtudiant()[0],"../../../../data/templatePDF.xlsx");

// Exporter vers PDF
$outputPath = "../../../../dataexport.xlsx";
$creationPdf->exportToPDF($outputPath);

echo "Le fichier a été exporter";