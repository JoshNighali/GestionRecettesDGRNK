
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recettes_dgrnk";

    try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Connection ok!";
    } catch (PDOException $e) {
    echo "Err: " . $e->getMessage();
    
    }

$conn = new mysqli($servername, $username, $password, $dbname);

  //check connection
 if ($conn->connect_error){
die("connection failed: ".$conn->connect_error);
 }
?>
  