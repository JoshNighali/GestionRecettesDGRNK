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
    ?>
<a href="add-agent.php" class="btn btn-large btn-primary">Ajouter un agent</a>
<button class="btn btn-dark" onclick="window.print()">Imprimer</button>
</div>

<div class="clearfix"></div><br />

<div class="container card table-responsive">
    <h3 class="text-center text-primary">Agents</h3>
     <table class='table table-striped table-dark' style="font-size: 90%;">
    <thead>
    <th>#</th>
     <th>Prénom</th>
     <th>Nom</th>
     <th>Etat civil</th>
     <th>Email</th>
     <th>Matricule</th>
     <th>Permission</th>
    </thead>

    <tbody>
    <?php
        $query = "select * from agents";         
        $agent->fill_table($query);
     ?>
    </tbody>
     
     
    
     
 
</table>
   
       
</div>

    <?php 
    include_once "../includes/footer.php";
}
    ?>

