<?php
// Inclure les fichiers nécessaires
require_once '../../../../lib/vendor/autoload.php';
//require_once('fpdi/src/autoload.php');

use setasign\Fpdi\Fpdi;


// Chemin vers le PDF existant
$existingPdf = '../../../../data/exemple.pdf';

// Créer une instance de FPDI
$pdf = new Fpdi();

$pdf->SetFont('Arial', '', 10);

// Ajouter chaque page du PDF existant
$pageCount = $pdf->setSourceFile($existingPdf);
for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
	$templateId = $pdf->importPage($pageNumber);
	$pdf->AddPage();
	$pdf->useTemplate($templateId);
}

$logo1           = new Logo('../../../../data/mimemu.jpg',11 ,3,60,20);
$logo2           = new Logo('../../../../data/mimemu.jpg',180,0,25,25);
$anneePromo      = new Logo('../../../../data/mimemu.jpg',141,24,32,8);
$nomDirecteur    = new Logo('../../../../data/mimemu.jpg',126,266,59,8);
$cachetDirecteur = new Logo('../../../../data/mimemu.jpg',126,278,61,15);




// Ajouter l'image à la page spécifiée
$x = 73; // Position horizontale de l'image
$y = 49; // Position verticale de l'image
$pdf->SetXY( $x, $y );
$pdf->Cell(0,0,"Boudeele Thomas",0,1,"L");


// Enregistrer le PDF résultant
$pdf->Output('../../../../data/test.pdf', 'F');

class Logo
{
    private $cheminVersImage;
    private $x;
    private $y;

    public function __construct($cheminVersImage, $x, $y, $width, $height)
    {
        $this->setCheminVersImage($cheminVersImage)->setX($x)->setY($y);
    }

    public function getCheminVersImage() { return $this->cheminVersImage; }
    public function setCheminVersImage($value) { $this->cheminVersImage = $value; return $this; }

    public function getX() { return $this->x; }
    public function setX($value) { $this->x = $value; return $this; }

    public function getY() { return $this->y; }
    public function setY($value) { $this->y = $value; return $this; }
}
