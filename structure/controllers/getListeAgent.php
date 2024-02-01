<?php

include'../models/Agent.php';

function getListeAgents(){
    return Agent :: getAgents();
}

?>