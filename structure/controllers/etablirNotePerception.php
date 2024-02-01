<?php 
include '../configuration/config.php';
include '../models/notePerception.php';


$num = $_POST['num'];
$date = $_POST['date'];
$categorie = $_POST['categorie'];
$impot = $_POST['impot'];

$note = new NotePerception ($num,$date, $categorie, $impot);
if ($note -> etablirNotePerception()){
    header("Location:../views/etablirNotePerception.php");
}

?>