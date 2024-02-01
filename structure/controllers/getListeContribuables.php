<?php

include'../models/Contribuable.php';

function getListeContribuables(){
    return Contribuable :: getContribuables();
}
 
?>