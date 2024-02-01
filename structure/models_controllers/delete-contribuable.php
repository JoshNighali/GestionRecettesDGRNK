<?php
session_start();
error_reporting(0);
if (empty( $_SESSION['sid'])){
    header("location:../../index.php");
}
else{
    include_once "../models_controllers/dbconfig.php";

    $id = $_GET['delete_id'];

if ($contribuable->delete($id))
        {
            echo "<script>window.location.href='../views/fichesDeclaration.php?status=3';</script>";
        }
        else
        {
            echo "<script>window.location.href='../views/fichesDeclaration.php?status=4';</script>";
        }
}
?>