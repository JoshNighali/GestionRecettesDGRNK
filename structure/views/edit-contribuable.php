<?php
session_start();
error_reporting(0);
if (empty( $_SESSION['sid'])){
    header("location:../../index.php");
}
else{
    include_once "../models_controllers/dbconfig.php";
    include_once "../includes/header.php";


    if(isset($_POST['save']))
    {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $age = $_POST['age'];
        $sexe = $_POST['sexe'];
        $adresse = $_POST['adresse'];
        $localisation_immeuble = $_POST['localisation_immeuble'];
        $nb_locataires = $_POST['nb_locataires'];
        $status = $_POST['stat'];
       
        
        
        if ($contribuable->edit_contribuable($nom, $prenom, $sexe, $adresse, $age, $localisation_immeuble, $nb_locataires, $status))
        {
            echo "<script>window.location.href='fichesDeclaration.php?status=1';</script>";
        }
        else
        {
            echo "<script>window.location.href='fichesDeclaration.php?status=2';</script>";
        }
    }


    ?>
    <div class="clearfix"></div>

<div class="container">

<div class="clearfix"></div><br />


<div class="container card">

 	 <h3 class="text-center text-primary"><i class="glyphicon glyphicon-plus"></i> Modifier Contribuable & Declaration</h3>
	 <form method='post'>
 
    <table class='table' style="border: 0;">
 
        <?php
        $id_r = $_GET['edit_id'];
        $query = "select * from fiche_paie where id=$id_r";         
        $contribuable->fill_form($query);
     ?>
		
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="save">
    		<span class="glyphicon glyphicon-plus"></span> Enregistrer déclaration
			</button>  
            <a href="fichesDeclaration.php" class="btn btn-large btn-success"><i class="fa fa-arrow-left"></i> &nbsp; Retour</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php 
    include_once "../includes/footer.php";
}
    ?>