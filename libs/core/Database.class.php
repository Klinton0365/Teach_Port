<?php
class Database
{
    public static $conn = null;

    public static function getConnection()
    {
        if (Database::$conn == null) {
            $server = "";
            $username = "";
            $password = "";
            $dbname = "";

            // Check if running on localhost or live server
            if ($_SERVER['SERVER_NAME'] === 'localhost') {
                // Localhost configuration
                $server = "mysql.selfmade.ninja";
                $username = "Klinton_03";
                $password = "432305";
                $dbname = "Klinton_03_onlinequize_0";
              
            } else {
                // Live server configuration
                $server = "mysql.selfmade.ninja";
                $username = "Klinton_03";
                $password = "Klinton@432305";
                $dbname = "Klinton_03_onlinequize_0";

            }
            // Create connection
            $connection = new mysqli($server, $username, $password, $dbname);
            
            // Check Connection
            if ($connection->connect_error) {
                die("Connection Failed: " . $connection->connect_error);
            } else {
                
                Database::$conn = $connection; 
                return Database::$conn;
            }
        } else {
            
            return Database::$conn;
        }
    }
}
