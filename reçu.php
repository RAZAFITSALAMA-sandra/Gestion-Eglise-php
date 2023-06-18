<?php
require('fpdf185/fpdf.php');
require "connect.php";
if (!empty($_GET['date1']) AND !empty($_GET['date2'])) {
    $date1=$_GET['date1'];
    $date2=$_GET['date2'];

    $sql_entre=$connexion->prepare("SELECT * FROM entre WHERE dateEntre between ? AND ?");
    $sql_entre->execute(array($date1,$date2));

    $req_entre=$connexion->prepare("SELECT SUM(montantEntre) as montantEntre FROM entre WHERE dateEntre between ? AND ?");
    $req_entre->execute(array($date1,$date2));
    $montantEntre=$req_entre->fetch()["montantEntre"];

    $req_sortie=$connexion->prepare("SELECT SUM(montantSortie) as montantSortie FROM sortie WHERE dateSortie between ? AND ?");
    $req_sortie->execute(array($date1,$date2));
    $montantSortie=$req_sortie->fetch()["montantSortie"];

    $sql_sortie=$connexion->prepare("SELECT * FROM sortie WHERE dateSortie between ? AND ?");
    $sql_sortie->execute(array($date1,$date2));
}
class PDF extends FPDF
{
// En-tête
function Header()
{
    // Police Arial gras 15
    $this->SetFont('Arial','B',15);
    // Décalage à droite
    $this->Cell(80);
    // Titre
    $this->Cell(30,10,utf8_decode('Réçu'),0,'C');
    // Saut de ligne
    $this->Ln(5);
}
// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Arial','I',8);
    // Numéro de page
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(50,10,utf8_decode("Mouvement de caisse entre ".$date1." et ".$date2),0,'C');
if ($sql_entre->rowCount()>0) {
	$pdf->Cell(50,10,utf8_decode("Mouvement d'entrée en caisse"),0,'C');
	$pdf->Cell(65,10,utf8_decode("Date entrée"),1,0,'C',0);
	$pdf->Cell(65,10,utf8_decode("Motif"),1,0,'C',0);
	$pdf->Cell(65,10,utf8_decode("Montant"),1,0,'C',0);
	$pdf->Ln(10);
	while ($entre=$sql_entre->fetch()) {
		$pdf->Cell(65,10,utf8_decode($entre['dateEntre']),1,0,'C',0);
		$pdf->Cell(65,10,utf8_decode($entre['motif']),1,0,'C',0);
		$pdf->Cell(65,10,utf8_decode($entre['montantEntre']),1,0,'C',0);
		$pdf->Ln(10);
	}
	$pdf->Cell(65,10,utf8_decode("Total montant entrant : ".$montantEntre." Ar"),0,'C',0);
}
if ($sql_sortie->rowCount()>0) {
	$pdf->Ln(5);
	$pdf->Cell(50,10,utf8_decode("Mouvement de sortie en caisse"),0,'C');
	$pdf->Cell(65,10,utf8_decode("Date sortie"),1,0,'C',0);
	$pdf->Cell(65,10,utf8_decode("Motif"),1,0,'C',0);
	$pdf->Cell(65,10,utf8_decode("Montant"),1,0,'C',0);
	$pdf->Ln(10);
	while ($sortie=$sql_sortie->fetch()) {
		$pdf->Cell(65,10,utf8_decode($sortie['dateSortie']),1,0,'C',0);
		$pdf->Cell(65,10,utf8_decode($sortie['motif']),1,0,'C',0);
		$pdf->Cell(65,10,utf8_decode($sortie['montantSortie']),1,0,'C',0);
		$pdf->Ln(10);
	}
	$pdf->Cell(65,10,utf8_decode("Total montant sortant : ".$montantSortie." Ar"),0,'C',0);
}
$pdf->Output();

?>