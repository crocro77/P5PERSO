<?php

// namespace App;

abstract class Database
{
    private static $db=null;
    private static $db_host='localhost';
    private static $db_name='gamegear';
    private static $db_user = 'root';
    private static $db_pass = '';
   
    public static function getDBConnection() {
        if(!self::$db){
            self::$db = new PDO('mysql:host=' . self::$db_host . ';dbname=' . self::$db_name . ';charset=utf8', self::$db_user, self::$db_pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));   
        }  
        return self::$db;
    }
}