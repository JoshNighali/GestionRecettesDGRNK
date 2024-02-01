<?php

class Contribuable{
    private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}

    // insert method
    function create_contribuable($nom, $prenom, $sexe, $adresse, $age, $localisation_immeuble, $nb_locataires, $status){
        try {
            //code...
            $stmt = $this->db->prepare("INSERT IGNORE INTO `fiche_paie`(`nom`, `prenom`, `sexe`, `age`, `adresse`, `localisation_immeuble`, `nb_locataires`, `status`) VALUES (:nom, :prenom, :sexe, :age, :adresse, :localisation_immeuble, :nb_locataires, :status)");

            $stmt->bindparam(":nom", $nom);
            $stmt->bindparam(":prenom", $prenom);
            $stmt->bindparam(":sexe", $sexe);
            $stmt->bindparam(":age", $age);
            $stmt->bindparam(":adresse", $adresse);
            $stmt->bindparam(":localisation_immeuble", $localisation_immeuble);
            $stmt->bindparam(":nb_locataires", $nb_locataires);
            $stmt->bindparam(":status", $status);
            $stmt->execute();

            return true;

        } catch (Exception $exc) {
            $exc->getMessage();
        }
    }

    public function getID($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM fiche_paie WHERE id=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}




    // table view

    function fill_table($query){
        $stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
            $cont=0;
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
                
                $cont++;
				?>
                <tr>
                    <td><?php echo htmlentities($cont); ?></td>
                    <td><?php echo htmlentities($row['nom']); ?></td>
                    <td><?php echo htmlentities($row['prenom']); ?></td>
                    <td><?php echo htmlentities($row['sexe']); ?></td>
                    <td><?php echo htmlentities($row['age']); ?></td>
                    <td><?php echo htmlentities($row['adresse']); ?></td>
                    <td><?php echo htmlentities($row['localisation_immeuble']); ?></td>
                    <td><?php echo htmlentities($row['nb_locataires']); ?></td>
                    <td><?php echo htmlentities($row['status']); ?></td>
     
                    <td style="min-width:200px;" id="hide">
                        <a href="edit-contribuable.php?edit_id=<?php echo htmlentities($row['id']); ?>"><button class="btn btn-success mb-2 btn-sm" style="font-size: 90%;">Modifier</button></a>

                        <a href="../models_controllers/delete-contribuable.php?delete_id=<?php echo htmlentities($row['id']); ?>"><button class="btn btn-danger mb-2 btn-sm" style="font-size: 90%;"><i class="fa fa-trash"></i></button></a>
                        <?php
                        if ($row['status']==0) {
                            // code...
                        ?>
                        <a href="../models_controllers/Transferer.php?contrib_id=<?php echo htmlentities($row['id']); ?>"><button class="btn btn-outline-primary mb-2 btn-sm" style="font-size: 90%;">Transferer</button></a>
                        <?php 
                    }
                    ?>
                    </td>
                </tr>
                <?php
                
			}
		}
		else
		{
			?>
            <option value="">Aucune donnée trouvée</option>
            <?php
		}
    }

     // table view

    function fill_form($query){
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    
        if($stmt->rowCount()>0)
        {
            $cont=0;
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                
                $cont++;
                ?>
                <tr>
            <td>Prénom</td>
            <td><input type='text' name='prenom' class='form-control' value="<?php echo htmlentities($row['prenom']); ?>" required></td>
        </tr>
 
        <tr>
            <td>Nom</td>
            <td><input type='text' name='nom' class='form-control' value="<?php echo htmlentities($row['nom']); ?>" required></td>
        </tr>
 
        <tr>
            <td>Age</td>
            <td><input type='number' name='age' class='form-control' value="<?php echo htmlentities($row['age']); ?>" required></td>
        </tr>
        
         <tr>
            <td>Sexe</td>
            <td>
                <select class="form-control" required name="sexe">
                    <option value="<?php echo htmlentities($row['sexe']); ?>" selected><?php echo htmlentities($row['sexe']); ?></option>
                </select>
            </td>
        </tr>
        
 
 
       <tr>
            <td>Adresse de résidence</td>
            <td><input type='text' name='adresse' class='form-control' value="<?php echo htmlentities($row['adresse']); ?>" required></td>
        </tr>
        
        
       <tr>
            <td>Adresse Immeuble</td>
            <td>
                <div class="row">
                    <div class="col-md-12 px-2 py-2">
                        <input type='text' name='localisation_immeuble' value="<?php echo htmlentities($row['localisation_immeuble']); ?>" class='form-control' placeholder="Adresse immeuble" required>
                    </div>                    
                </div>
            </td>
        </tr>
        
         <tr>
            <td>Nombre de locataires</td>
            <td><input type='number' name='nb_locataires' value="<?php echo htmlentities($row['nb_locataires']); ?>" class='form-control' required></td>
        </tr>
        <tr>
            <td>Statut</td>
            <td><input type='number' name='stat' value="<?php echo htmlentities($row['status']); ?>" class='form-control' required readonly></td>
        </tr>

                <?php
                
            }
        }
        else
        {
            ?>
            <option value="">Aucune donnée trouvée</option>
            <?php
        }
    }



    // edit contribuable

    function edit_contribuable($nom, $prenom, $sexe, $adresse, $age, $localisation_immeuble, $nb_locataires, $status){
        try {
            //code...
            $id = $_GET['edit_id'];
            $stmt=$this->db->prepare("UPDATE `fiche_paie` SET `nom`=:nom,`prenom`=:prenom,`sexe`=:sexe,`age`=:age,`adresse`=:adresse,`localisation_immeuble`=:localisation_immeuble,`nb_locataires`=:nb_locataires,`status`=:status WHERE id=:id)");

            $stmt->bindparam(":nom", $nom);
            $stmt->bindparam(":prenom", $prenom);
            $stmt->bindparam(":sexe", $sexe);
            $stmt->bindparam(":age", $age);
            $stmt->bindparam(":adresse", $adresse);
            $stmt->bindparam(":localisation_immeuble", $localisation_immeuble);
            $stmt->bindparam(":nb_locataires", $nb_locataires);
            $stmt->bindparam(":status", $status);
            $stmt->bindparam(":id",$id);
			
			return true;
        } catch (Exception $th) {
            $th->getMessage();
        }
        
    }

    // delete contribuable

    public function delete($id)
	{
		try{
			$stmt = $this->db->prepare("DELETE FROM fiche_paie WHERE id=:id");
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
		
		
	}

    // transferer contribuable

   public function transferer($id)
    {
        try{
            $stmt = $this->db->prepare("UPDATE fiche_paie SET status=1 WHERE id=:id");
            $stmt->bindparam(":id",$id);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();  
            return false;
        }
        
        
    }






}

?>