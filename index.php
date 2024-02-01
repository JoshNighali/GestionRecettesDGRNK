<?php
session_start();
error_reporting(0);
include('structure/configuration/config.php');

if(isset($_POST['login']))
{
  $username=$_POST['matricule'];
  $password=sha1(md5($_POST['password']));// hashage du mot de passe a deux niveaux

  $sql ="SELECT * FROM agents WHERE matricule=:username and Password=:password ";
  $query=$db->prepare($sql);

  $query-> bindParam(':username', $username, PDO::PARAM_STR);
  $query-> bindParam(':password', $password, PDO::PARAM_STR);
  $query-> execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);

       
    
  if($query->rowCount() > 0)
  {
    foreach ($results as $result) {
      $_SESSION['sid']=$result->id;
      $_SESSION['name']=$result->nom;
      $_SESSION['lastname']=$result->prenom;
      $_SESSION['permission']=$result->permission;
      $_SESSION['email']=$result->email;

    }

    if(!empty($_POST["remember"])) {
      //COOKIES for username
      setcookie ("user_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
      //COOKIES for password
      setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
    } else {
      if(isset($_COOKIE["user_login"])) {
        setcookie ("user_login","");
        if(isset($_COOKIE["userpassword"])) {
          setcookie ("userpassword","");
        }
      }
    }
    $aa= $_SESSION['sid'];
    $sql="SELECT * from agents  where id=:aa";
    $query = $db -> prepare($sql);
    $query->bindParam(':aa',$aa,PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);

    $cnt=1;
    if($query->rowCount() > 0)
    {
      foreach($results as $row)
      {

        if($row->permission=="agent taxateur"){
          $extra="structure/views/fichesDeclaration.php";
          $username=$_POST['username'];
          $email=$_SESSION['email'];
          $name=$_SESSION['name'];
          $lastname=$_SESSION['lastname'];

          $_SESSION['login']=$_POST['username'];
          $_SESSION['id']=$num['id'];
          $_SESSION['username']=$num['name'];
          $uip=$_SERVER['REMOTE_ADDR'];         
          $host=$_SERVER['HTTP_HOST'];
          $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
          header("location:http://$host$uri/$extra");
          exit();
        }
        if($row->permission=="Recouvreur"){
          $extra="structure/views/notesPerception.php";
          $username=$_POST['username'];
          $email=$_SESSION['email'];
          $name=$_SESSION['name'];
          $lastname=$_SESSION['lastname'];

          $_SESSION['login']=$_POST['username'];
          $_SESSION['id']=$num['id'];
          $_SESSION['username']=$num['name'];
          $uip=$_SERVER['REMOTE_ADDR'];         
          $host=$_SERVER['HTTP_HOST'];
          $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
          header("location:http://$host$uri/$extra");
          exit();
        }

         else {
          echo "<script>document.location ='index.php?status=5';</script>";
        }

      } }
    } else{
      $extra="index.php?status=2";
      $host  = $_SERVER['HTTP_HOST'];
      $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
      echo "<script>document.location ='http://$host$uri/$extra';</script>";
    }
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Gestion Recettes - DGRNK</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: transparent;background-image: url('images/solution-strategie-gestion-entreprise-concept-marque.jpg');background-repeat: no-repeat;background-size: cover;">
	
	<div class="container">
		<div class="row py-4">
			<div class="col-md-4"></div>
			<div class="col-md-4 mt-4">
				<div class="row px-3 py-3">
					<div class="col-md-12 card mt-2" id="login-card" style="height: auto;backdrop-filter: blur(10px);background-color: transparent;box-shadow: 0 0 5px black;">

						
						<div class="alert mt-3">
							<h3 class="text-center mt-3 text-white">Connexion</h3>
							<hr>
							<?php
								if (isset($_GET['status'])==2) {
								 	// code...
								 	?>
								 	<div class="alert alert-danger" role="alert" style="font-size: 90%;">
  										Vos identifiants sont incorrects! Veillez réessayer.
									</div>
								 	<?php
								 } 
							?>
							<form method="POST">
								<div class="mb-3">
  									<label for="exampleFormControlInput1" class="form-label text-white">Matricule</label>
  									<input type="number" class="form-control" name="matricule" id="exampleFormControlInput1" placeholder="Entrer votre matricule" autocomplete="off" required>
								</div>

								<div class="mb-3">
  									<label for="exampleFormControlInput2" class="form-label text-white">Mot de passe</label>
  									<input type="password" class="form-control" name="password" id="exampleFormControlInput2" placeholder="Mot de passe" autocomplete="off" required>
								</div>

								<div class="mb-3">
  									<button type="submit" name="login" class="btn btn-block btn-primary">Se connecter</button>
								</div>

								<div class="mb-3">
  									<button type="reset" class="btn btn-block btn-dark">Annuler</button>
								</div>
							</form>

							
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>