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
        $id_contribuable = $_POST['id_contribuable'];
        $montant = $_POST['montant'];
        $motif = $_POST['motif'];
        $type_paie = $_POST['type_paie'];
       
       
        
        
        if ($note->create_note($id_contribuable, $type_paie, $montant, $motif))
        {
            echo "<script>window.location.href='notesPerception.php?status=1';</script>";
        }
        else
        {
            echo "<script>window.location.href='notesPerception.php?status=2';</script>";
        }
    }


    ?>
    <div class="clearfix"></div>

<div class="container">

<div class="clearfix"></div><br />


<div class="container card">

 	 <h3 class="text-center text-primary"><i class="glyphicon glyphicon-plus"></i> Editer une note de préscription</h3>
	 <form method='post'>
 
    <table class='table' style="border: 0;">
 
 
        <tr>
            <td>Contribuable</td>
            <td>
                <select class="form-control" name="id_contribuable" required>
                <?php
                    $query = "SELECT * FROM fiche_paie where status=1";       
                    $note->fill_list_contribuables($query);
                ?>
                </select>
            </td>
        </tr>
 
        <tr>
            <td>Montant</td>
            <td><input type='number' name='montant' class='form-control' required></td>
        </tr>
	
 
       <tr>
            <td>Motif de paiement</td>
            <td><input type='text' name='motif' class='form-control' required></td>
        </tr>
		
	
		
		 <tr>
            <td>Type de paiement</td>
            <td>
                <select class="form-control" required name="type_paie">
                    <option value="Compte bancaire" selected>Compte bancaire</option>
                    <option value="Espece">Espece</option>
                </select>
            </td>
        </tr>
		
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="save">
    		<span class="glyphicon glyphicon-plus"></span> Enregistrer déclartion
			</button>  
            <a href="notesPerception.php" class="btn btn-large btn-success"><i class="fa fa-arrow-left"></i> &nbsp; Retour</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php 
    include_once "../includes/footer.php";
}
    ?>