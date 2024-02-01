<?php 
include '../configuration/config.php';
include '../models/ficheDeclaration.php';


$num = $_POST['num'];
$date = $_POST['date'];
$dateVal= $_POST['dateVal'];
$observation = $_POST['observation'];

$fiche = new FicheDeclaration ($num,$date, $dateVal, $observation);
if ($fiche -> remplirFiche()){
    header("Location:../views/remplirFiche.php");
}

?>