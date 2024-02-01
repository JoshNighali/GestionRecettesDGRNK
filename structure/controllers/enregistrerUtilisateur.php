<?php 
include '../configuration/config.php';
include '../models/Utilisateur.php';
include '../models/agent.php';


$idUtil = $_POST['idUtil'];
$pass_word = sha1(md5($_POST['pass_word']));
$typeCompte = $_POST['typeCompte'];
$dateAjout = $_POST['dateAjout'];
$dateModif = $_POST['dateModif'];
$statutCompte = $_POST['statutCompte'];

$matricule = rand(0,10000);
$nom = $_POST['nom'];
$numTel = $_POST['contact'];
$adresse = $_POST['address'];
$email = $_POST['email'];
$fonction = $_POST['fonction'];

$utilisateur = new Utilisateur ($idUtil,$pass_word, $typeCompte, $dateAjout,$dateModif, $statutCompte);
if ($utilisateur -> EnregistrerUtilisateur()){

$agent = new Agent ($matricule,$nom, $numTel, $adresse,$email, $fonction);
if ($agent -> enregistrerAgent()){
    header("Location:../views/EnregistrerUtilisateur.php?status=1");
}
}

?>