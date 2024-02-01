<?php

include'../models/ficheDeclaration.php';

function getListeFiches(){
    return FicheDeclaration :: getFiches();
}

?>