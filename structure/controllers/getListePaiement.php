<?php

include'../models/Paiement.php';

function getListePaiements(){
    return Paiement :: getPaiements();
}

?>