<?php
session_start();
error_reporting(0);
if (empty( $_SESSION['sid'])){
    header("location:../../index.php");
}
else{
    include_once "../models_controllers/dbconfig.php";

    $id = $_GET['contrib_id'];

if ($contribuable->transferer($id))
        {
            echo "<script>window.location.href='../views/fichesDeclaration.php?status=5';</script>";
        }
        else
        {
            echo "<script>window.location.href='../views/fichesDeclaration.php?status=6';</script>";
        }
}
    ?>