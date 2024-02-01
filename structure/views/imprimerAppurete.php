<?php
session_start();
error_reporting(0);
if (empty( $_SESSION['sid'])){
    header("location:../../index.php");
}
else{
    include_once "../models_controllers/dbconfig.php";
    include_once "../includes/header.php";


    ?>
    <div class="clearfix"></div>

<div class="container" id="hide">
    <?php
        if ($_GET['status']==2) {
             // code...
            ?>
            <div class="alert alert-danger" role="alert">
                 Echec d'enregistrement!
            </div>
            <?php
         } 
         else if ($_GET['status']==1) {
             // code...
            ?>
            <div class="alert alert-success" role="alert">
                 Enregistrement réussi!
            </div>
            <?php
         }
         else if ($_GET['status']==3) {
             // code...
            ?>
            <div class="alert alert-warning" role="alert">
                 Supression réussie!
            </div>
            <?php
         }
         else if ($_GET['status']==4) {
             // code...
            ?>
            <div class="alert alert-dark" role="alert">
                 Echec de suppression!
            </div>
            <?php
         }
         else if ($_GET['status']==5) {
             // code...
            ?>
            <div class="alert alert-success" role="alert">
                 Paiement validé!
            </div>
            <?php
         }
    ?>
<a href="paiements.php" class="btn btn-large btn-success"><i class="fa fa-arrow-left"></i> Retour</a>

<button class="btn btn-dark" onclick="window.print()">Imprimer</button>
</div>

<div class="clearfix"></div><br />

<div class="container">
    <h3 class="text-center text-primary">Appureté de paiement</h3>
     <table class='table table-bordered'>
    
    <?php
    $note_id = $_GET['note_id'];
        $query = "select note_perception.*, fiche_paie.nom,fiche_paie.age,fiche_paie.adresse, fiche_paie.prenom, fiche_paie.localisation_immeuble, fiche_paie.nb_locataires from note_perception, fiche_paie where note_perception.id_contribuable=fiche_paie.id and note_perception.id=$note_id";         
        $note->fill_grid($query);
     ?>     
     
</table>
   
       
</div>

    <?php 
    include_once "../includes/footer.php";
}
    ?>

