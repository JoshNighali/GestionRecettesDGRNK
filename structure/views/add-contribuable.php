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
        $localisation_immeuble = $_POST['ville'].", ".$_POST['quartier'].", ".$_POST['avenue'].", ".$_POST['numero'];
        $nb_locataires = $_POST['nb_locataires'];
        $status = 0;
       
        
        
        if ($contribuable->create_contribuable($nom, $prenom, $sexe, $adresse, $age, $localisation_immeuble, $nb_locataires, $status))
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


<div class="container">

 	 <h3 class="text-center text-primary"><i class="glyphicon glyphicon-plus"></i> Ajouter Contribuable & Declarer immeuble</h3>
	 <form method='post'>
 
    <table class='table' style="border: 0;">
 
        <tr>
            <td>Prénom</td>
            <td><input type='text' name='prenom' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>Nom</td>
            <td><input type='text' name='nom' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>Age</td>
            <td><input type='text' name='age' class='form-control' required></td>
        </tr>
		
		 <tr>
            <td>Sexe</td>
            <td>
                <select class="form-control" required name="sexe">
                    <option value="Homme" selected>Homme</option>
                    <option value="Femme">Femme</option>
                </select>
            </td>
        </tr>
		
 
 
       <tr>
            <td>Adresse de résidence</td>
            <td><input type='text' name='adresse' class='form-control' required></td>
        </tr>
		
		
       <tr>
            <td>Adresse Immeuble</td>
            <td>
                <div class="row">
                    <div class="col-md-3 px-2 py-2">
                        <input type='text' name='ville' class='form-control' placeholder="Ville" required>
                    </div>

                    <div class="col-md-3 px-2 py-2">
                        <input type='text' name='quartier' class='form-control' placeholder="Quartier" required>
                    </div>

                    <div class="col-md-3 px-2 py-2">
                        <input type='text' name='avenue' class='form-control' placeholder="Avenue" required>
                    </div>

                    <div class="col-md-3 px-2 py-2">
                        <input type='number' name='numero' class='form-control' placeholder="Numero" required>
                    </div>
                </div>
            </td>
        </tr>
		
		 <tr>
            <td>Nombre de locataires</td>
            <td><input type='number' name='nb_locataires' class='form-control' required></td>
        </tr>
		
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