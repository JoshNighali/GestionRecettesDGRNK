<?php

class Note{
    private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}

    // insert method
    function create_note($id_contribuable, $type_paie, $montant, $motif){
        try {
            //code...
            $stmt = $this->db->prepare("INSERT IGNORE INTO `note_perception`(`id_contribuable`, `type_paie`, `montant`, `motif`) VALUES (:id_contribuable, :type_paie, :montant, :motif)");

            $stmt->bindparam(":id_contribuable", $id_contribuable);
            $stmt->bindparam(":type_paie", $type_paie);
            $stmt->bindparam(":montant", $montant);
            $stmt->bindparam(":motif", $motif);
            $stmt->execute();

            return true;

        } catch (Exception $exc) {
            $exc->getMessage();
        }
    }

    public function getID($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM note_perception WHERE id=:id");
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
            $counter=1;
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
                
				?>
                <tr>
                    <td><?php echo htmlentities($counter); ?></td>
                    <td><?php echo htmlentities($row['prenom']); ?></td>
                    <td><?php echo htmlentities($row['nom']); ?></td>
                    <td><?php echo htmlentities($row['localisation_immeuble']); ?></td>
                    <td><?php echo htmlentities($row['nb_locataires']); ?></td>
                    <td><?php echo htmlentities($row['motif']); ?></td>
                    <td><?php echo htmlentities($row['montant']); ?></td>
                    <td><?php echo htmlentities($row['type_paie']); ?></td>
                    <td><?php echo htmlentities($row['date']); ?></td>
     
                    <td style="min-width: 210px;" id="hide">
                        <?php 
                if ($row['status']==0) {
                    // code...
                    ?>
                        <a href="../models_controllers/delete-note.php?delete_id=<?php echo htmlentities($row['id']); ?>"><button class="btn btn-danger mb-2 btn-sm" style="font-size: 90%;"><i class="fa fa-trash"></i></button></a>

                        <a href="../models_controllers/valid_status.php?valid_id=<?php echo htmlentities($row['id']); ?>"><button class="btn btn-primary mb-2 btn-sm" style="font-size: 90%;">Valider paiement</button></a>

                        <a href="imprimer.php?note_id=<?php echo htmlentities($row['id']); ?>"><button class="btn btn-outline-light mb-2 btn-sm" style="font-size: 90%;"><i class="fa fa-print"></i></button></a>
                    <?php }
                    else{
                        ?>
                        <a href="imprimerAppurete.php?note_id=<?php echo htmlentities($row['id']); ?>"><button class="btn btn-outline-light mb-2 btn-sm" style="font-size: 90%;"><i class="fa fa-print"></i> Imprimer appureté</button></a>
                        <?php
                    } ?>
                    </td>
                </tr>
                <?php
                $counter++;
			}
		}
		else
		{
			?>
            <div class="alert alert-danger">Aucune donnée trouvée</div>
            <?php
		}
    }


// imprimer la note de perception

     function fill_grid($query){
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    
        if($stmt->rowCount()>0)
        {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                $counter=1;
                ?>
                <tr>
                    <td>Noms : </td>
                    <td><?php echo htmlentities($row['prenom']." ".$row['nom']); ?></td>
                </tr>

                <tr>
                    <td>Age : </td>
                    <td><?php echo htmlentities($row['age']." ans"); ?></td>
                </tr>

                <tr>
                    <td>Adresse de résidence</td>
                    <td><?php echo htmlentities($row['adresse']); ?></td>
                </tr>

                <tr>
                    <td>Localisation Immeuble : </td>
                    <td><?php echo htmlentities($row['localisation_immeuble']); ?></td>
                </tr>

                <tr>
                    <td>Nombre de locataires : </td>
                    <td><?php echo htmlentities($row['nb_locataires']); ?></td>
                </tr>

                <tr>
                    <td>Montant :</td>
                    <td><?php echo htmlentities($row['montant']." FC"); ?></td>
                </tr>

                <tr>
                    <td>Date :</td>
                    <td><?php echo htmlentities($row['date']); ?></td>
                </tr>
                <?php 
                if ($row['status']==0) {
                    // code...
                    ?>
                    <tr class="alert alert-danger">
                        <td>Statut :</td>
                        <td>Déclaration non payée</td>
                    </tr>

                    <?php
                }
                else{
                    ?>
                    <tr class="alert alert-success">
                        <td>Statut :</td>
                        <td>Déclaration payée</td>
                    </tr>
                    <?php
                }

                ?>
                
                <?php
                $counter++;
            }
        }
        else
        {
            ?>
            <div class="alert alert-danger">Aucune donnée trouvée</div>
            <?php
        }
    }



    // valider le payement

   public function valid_paie($id)
    {
        try{
            $stmt = $this->db->prepare("UPDATE note_perception SET status=1 WHERE id=:id");
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

    // supprimer la note

    public function delete($id)
	{
		try{
			$stmt = $this->db->prepare("DELETE FROM note_perception WHERE id=:id");
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


    function fill_list_contribuables($query){
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    
        if($stmt->rowCount()>0)
        {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                ?>
                <option value="<?php echo htmlentities($row['id']); ?>"><?php print($row['nom']." ".$row['prenom']." ".$row['adresse']); ?></option>
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






}

?>