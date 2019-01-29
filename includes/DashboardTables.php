<?php

// class DashboardTables extends Twig_Extension
// {
    // public function dashboardExtension()
    // {
        $tables = [
            "Fiche(s)"              =>  "datasheet",
            "Commentaire(s)"        =>  "comments",
            "Membre(s)"             =>  "users",
            "Ligne(s) sur le Chat"  =>  "chat",
        ];
        $colors = [
            "datasheet"             =>  "green",
            "comments"              =>  "orange",
            "users"                 =>  "blue",
            "chat"                  =>  "red",
        ];

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
    // }
// }