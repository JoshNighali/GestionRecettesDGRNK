<?php

class Agent{
    private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}

    // insert method
    function create_agent($nom, $prenom, $sexe, $age, $etat_civil, $matricule, $permission, $status, $email, $password){
        try {
            //code...
            $stmt = $this->db->prepare("INSERT IGNORE INTO `agents`(`nom`, `prenom`, `sexe`, `age`, `etat_civil`, `matricule`, `permission`, `status`, `email`, `password`) VALUES (:nom, :prenom, :sexe, :age, :etat_civil, :matricule, :permission, :status, :email, :password)");

            $stmt->bindparam(":nom", $nom);
            $stmt->bindparam(":prenom", $prenom);
            $stmt->bindparam(":sexe", $sexe);
            $stmt->bindparam(":age", $age);
            $stmt->bindparam(":etat_civil", $etat_civil);
            $stmt->bindparam(":matricule", $matricule);
            $stmt->bindparam(":permission", $permission);
            $stmt->bindparam(":status", $status);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":password", $password);
            $stmt->execute();

            return true;

        } catch (Exception $exc) {
            $exc->getMessage();
        }
    }

    public function getID($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM agents WHERE id=:id");
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
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
                $counter=1;
				?>
                <tr>
                    <td><?php echo htmlentities($counter); ?></td>
                    <td><?php echo htmlentities($row['prenom']); ?></td>
                    <td><?php echo htmlentities($row['nom']); ?></td>
                    <td><?php echo htmlentities($row['etat_civil']); ?></td>
                    <td><?php echo htmlentities($row['email']); ?></td>
                    <td><?php echo htmlentities($row['matricule']); ?></td>
                    <td><?php echo htmlentities($row['permission']); ?></td>
     
                    
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


// editer l'agent

     function edit_agent($query){
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


    // supprimer la note

    public function delete($id)
	{
		try{
			$stmt = $this->db->prepare("DELETE FROM agents WHERE id=:id");
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