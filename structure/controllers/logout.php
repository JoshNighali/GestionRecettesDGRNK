<?php
session_start();
session_destroy();
header("Location: ../index.php"); // Rediriger vers la page de connexion