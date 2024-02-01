<?php 
include '../configuration/config.php';
include '../models/paiement.php';


$codeRef = $_POST['codeRef'];
$dateP = $_POST['dateP'];
$montant = $_POST['montant'];
$statutP = $_POST['statutP'];
$dateVal = $_POST['dateVal'];

$paiement = new Paiement  ($codeRef,$dateP, $montant, $statutP,$dateVal);
if ($paiement -> validerPaiement()){
    header("Location:../views/validerPaiement.php");
}

?>