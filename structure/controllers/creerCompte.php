<?php 
include '../configuration/config.php';
include '../models/compte.php';


$num = $_POST['num'];
$solde = $_POST['solde'];
$devise = $_POST['devise'];
$nomBanque = $_POST['nomBanque'];
$dateDepot = $_POST['dateDepot'];
$dateRetrait = $_POST['dateRetrait'];

$compte = new Compte ($num,$solde, $devise, $nomBanque,$dateDepot, $dateRetrait);
if ($compte -> creerCompte()){
    header("Location:../views/creerCompte.php");
}

?>