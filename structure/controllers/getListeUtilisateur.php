<?php

include'../models/Utilisateur.php';

function getListeUtilisateurs(){
    return Utilisateur :: getUtilisateurs();
}

?>