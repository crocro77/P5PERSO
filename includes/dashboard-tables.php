<?php
// tableau de couleur des tables de la bdd pour le dashboard
function inTable($table){
    $db = Database::getDBConnection();
    $query = $db->query("SELECT COUNT(id) FROM $table");
    return $nombre = $query->fetch();
}

function getColor($table,$colors){
    if(isset($colors[$table])){
        return $colors[$table];
    }else{
        return "lightblue";
    }
}