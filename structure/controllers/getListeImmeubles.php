<?php

include'../models/Immeuble.php';

function getListeImmeubles(){
    return Immeuble :: getImmeubles();
}

?>