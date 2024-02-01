<?php
include_once 'dbconfig.php';
?>
<?php include_once 'header.php'; ?>
<?php 
    if(isset($_POST['save']))
    {
        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $position = $_POST['position'];
        $number = $_POST['number'];
        
	
	if($player->edit_player($id,$fname,$lname,$number,$position,$height,$weight,$college,$country,$salary,$state))
	{
        echo "<script>alert('The player\'s info has been modified!');</script>";
        echo "<script>window.location.href='index.php';</script>";
    }
    else
    {
        echo "<script>alert('Failure!');</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
}

if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($player->getID($id));	
}

?>
<div class="container">

 	 <h1 class="text-center text-primary"><i class="glyphicon glyphicon-edit"></i> Edit player</h1>
	 <form method='post'>
 
    <table class='table table-bordered'>
 
        <tr>
            <td>First Name</td>
            <td><input type='text' name='first_name' class='form-control' value="<?php echo $first_name; ?>" required></td>
        </tr>
 
        <tr>
            <td>Last Name</td>
            <td><input type='text' name='last_name' class='form-control' value="<?php echo $last_name; ?>" required></td>
        </tr>
 
        <tr>
            <td>Height</td>
            <td><input type='text' name='height' class='form-control'  value="<?php echo $height; ?>" required></td>
        </tr>
		
		 <tr>
            <td>Weight</td>
            <td><input type='text' name='weight' class='form-control'  value="<?php echo $weight; ?>" required></td>
        </tr>
		
		 <tr>
            <td>Country</td>
            <td>
            
                <select class="form-control" name="country" required>
                <?php
		            $query = "SELECT * FROM country";  		
		            $player->fill_list_country($query);
	            ?>
                </select>
            </td>
        </tr>
		
		 <tr>
            <td>State</td>
            <td>
            <select class="form-control" name="state" required>
            <?php
		            $query = "SELECT * FROM state";  		
		            $player->fill_list_state($query);
	            ?>
                </select>
            </td>
        </tr>

        <tr>
            <td>College</td>
            <td>
            <select class="form-control" name="college" required>
            <?php
		            $query = "SELECT * FROM `college`";  		
		            $player->fill_list_college($query);
	            ?>
                </select>
            </td>
        </tr>
 
 
       <tr>
            <td>Position</td>
            <td><input type='text' name='position' class='form-control'  value="<?php echo $position; ?>" required></td>
        </tr>
		
		
       <tr>
            <td>Number</td>
            <td><input type='text' name='number' class='form-control'  value="<?php echo $number; ?>" required></td>
        </tr>
		
		 <tr>
            <td>Salary</td>
            <td><input type='text' name='salary' class='form-control'  value="<?php echo $salary; ?>" required></td>
        </tr>
		
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="save">
    		<span class="glyphicon glyphicon-edit"></span> Update player
			</button>  
            <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>