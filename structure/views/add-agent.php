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
        $email = $_POST['email'];
        $sexe = $_POST['sexe'];
        $age = $_POST['age'];
        $etat_civil = $_POST['etat_civil'];
        $permission = $_POST['permission'];
        $matricule = rand(1, 456).rand(0, 8);
        $password = sha1(md5($_POST['password']));
        $status = 1;
       
        
        
        if ($agent->create_agent($nom, $prenom, $sexe, $age, $etat_civil, $matricule, $permission, $status, $email, $password))
        {
            echo "<script>window.location.href='agents.php?status=1';</script>";
        }
        else
        {
            echo "<script>window.location.href='agents.php?status=2';</script>";
        }
    }


    ?>
    <div class="clearfix"></div>

<div class="container">

<div class="clearfix"></div><br />


<div class="container card">

 	 <h3 class="text-center text-primary"><i class="glyphicon glyphicon-plus"></i> Ajouter un agent</h3>
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
            <td><input type='number' name='age' class='form-control' required></td>
        </tr>

        <tr>
            <td>Etat civil</td>
            <td>
                <select class="form-control" required name="etat_civil">
                    <option value="Marié" selected>Marié</option>
                    <option value="Celibataire">Celibataire</option>
                </select>
            </td>
        </tr>
 
        <tr>
            <td>Email</td>
            <td><input type='email' name='email' class='form-control' required></td>
        </tr>
		
		 <tr>
            <td>Permission</td>
            <td>
                <select class="form-control" required name="permission">
                    <option value="Agent taxateur" selected>Agent taxateur</option>
                    <option value="Recouvreur">Recouvreur</option>
                </select>
            </td>
        </tr>
		
 
 
       <tr>
            <td>Mot de passe</td>
            <td><input type='password' name='password' class='form-control' required></td>
        </tr>
		

		
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="save">
    		<span class="glyphicon glyphicon-plus"></span> Enregistrer agent
			</button>  
            <a href="agents.php" class="btn btn-large btn-success"><i class="fa fa-arrow-left"></i> &nbsp; Retour</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php 
    include_once "../includes/footer.php";
}
    ?>