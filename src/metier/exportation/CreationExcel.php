<?php
// Inclure l'autoloader de Composer
require_once '../../../lib/vendor/autoload.php';
require_once '../../donnee/Etudiant.inc.php';
require_once '../../controleur/ControleurDB.inc.php';

// Importer les classes nécessaires de PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CreationExcel
{
    private $DB;

    public function __construct()
    {
        $this->DB = DB::getInstance();
    }

    public function fichierJury()
    {
        $classeur = new Spreadsheet();
        $feuilleActive = $classeur->getActiveSheet();
        $feuilleActive->setTitle('PV Jury');

        $etudiantTEST = new Etudiant(1, 'test', 'test', 'test', 'test', -1);
        $tabAttributEtudiant = array_keys($etudiantTEST->getAttributs());

        // Placer les noms des attributs des étudiants en tant qu'en-têtes de colonne
        foreach ($tabAttributEtudiant as $index => $attribut) {
            $feuilleActive->setCellValue('A1', $attribut);
        }

        // Enregistrer le fichier Excel dans le répertoire data
        $writer = new Xlsx($classeur);
        $cheminFichier = '../../data/jury.xlsx';
        $writer->save($cheminFichier);

        echo 'Le fichier excel Jury a bien été créé';
    }
}

// Créer une instance de la classe CreationExcel et appeler la méthode fichierJury()
$creationExcel = new CreationExcel();
$creationExcel->fichierJury();
?>
