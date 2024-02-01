<?php

$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "recettes_dgrnk";


try
{
	$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

$con = mysqli_connect($DB_host,$DB_user,$DB_pass,$DB_name);
// Verifier la connexion
// mysqli pour la lecture des données
if (mysqli_connect_error())
{
	echo "Echec de connexion à la base des données : " . mysqli_connect_error();
}



include_once 'class.contribuable.php';
include_once 'class.note.php';
include_once 'class.agents.php';

$contribuable = new Contribuable($DB_con);

$note = new Note($DB_con);

$agent = new Agent($DB_con);

?>