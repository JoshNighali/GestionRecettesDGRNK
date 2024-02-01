<?php 
include '../configuration/config.php';
include '../models/Immeuble.php';


$idImmeuble = $_POST['idImmeuble'];
$numImmeuble = $_POST['numImmeuble'];
$rue = $_POST['rue'];
$quartier = $_POST['quartier'];
$commune = $_POST['commune'];
$ville = $_POST['ville'];
$nbrelocataire = $_POST['nbrelocataire'];

$immeuble = new Immeuble ($idImmeuble,$numImmeuble, $rue, $quartier,$commune, $ville,$nbrelocataire);
if ($immeuble -> declarerImmeuble()){
    header("Location:../views/DeclarerImmeuble.php?status=1");
}

?>