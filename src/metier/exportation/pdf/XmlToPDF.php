<?php
require_once 'fpdf.php'; // Assurez-vous d'avoir inclus la bibliothèque FPDF

class XMLtoPDFConverter
{
    private $xmlFilePath;
    private $pdf;

    public function __construct($xmlFilePath)
    {
        $this->xmlFilePath = $xmlFilePath;
        $this->pdf = new FPDF();
    }

    public function generatePDF()
    {
        // Vérifier si le fichier XML existe
        if (!file_exists($this->xmlFilePath)) {
            die('Le fichier XML spécifié n\'existe pas.');
        }

        // Charger le contenu XML
        $xmlString = file_get_contents($this->xmlFilePath);
        $xml = new SimpleXMLElement($xmlString);

        // Créer une nouvelle page dans le PDF
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', '', 12);

        // Ajouter les données du XML dans le PDF
        foreach ($xml->children() as $elementName => $elementValue) {
            $this->pdf->Cell(0, 10, $elementName . ': ' . $elementValue, 0, 1);
        }

        // Enregistrer le PDF
        $pdfFileName = pathinfo($this->xmlFilePath, PATHINFO_FILENAME) . '.pdf';
        $this->pdf->Output($pdfFileName, 'F');

        echo 'Le fichier PDF a été généré avec succès : ' . $pdfFileName;
    }
}

// Utilisation de la classe
$converter = new XMLtoPDFConverter('Avis_Poursuite_etudes_modele.xml');
$converter->generatePDF();
?>
