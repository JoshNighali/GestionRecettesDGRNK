<?php 
include '../configuration/config.php';
include '../models/agent.php';


$matricule = $_POST['matricule'];
$nom = $_POST['nom'];
$numTel = $_POST['numTel'];
$adresse = $_POST['adresse'];
$email = $_POST['email'];
$fonction = $_POST['fonction'];

$agent = new Agent ($matricule,$nom, $numTel, $adresse,$email, $fonction);
if ($agent -> enregistrerAgent()){
    header("Location:../views/EnregistrerAgent.php");
}

?>