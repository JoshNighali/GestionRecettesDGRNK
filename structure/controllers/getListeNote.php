<?php

include'../models/NotePerception.php';

function getListeNotes(){
    return NotePerception :: getNotes();
}

?>