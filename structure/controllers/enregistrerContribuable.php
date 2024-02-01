<?php 
include '../configuration/config.php';
include '../models/contribuable.php';


$idCont = $_POST['idCont'];
$nomComplet = $_POST['nomComplet'];
$numTel = $_POST['numTel'];
$adresse = $_POST['adresse'];
$email = $_POST['email'];
$profession = $_POST['profession'];

$contribuable = new Contribuable ($idCont,$nomComplet, $numTel, $adresse,$email, $profession);
if ($contribuable -> enregisterContribuable()){
    header("Location:../views/EnregistrerContribuable.php?status=1");
}

?>