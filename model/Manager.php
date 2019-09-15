<?php


class Manager
{
    
    protected function dbConnect()
    {
        $connectionFile = fopen('config/connection.db', 'r');
        
        $connectionString = rtrim(fgets($connectionFile));
        $user=rtrim(fgets($connectionFile));
        $password=rtrim(fgets($connectionFile));

        fclose($connectionFile);

        $db = new PDO($connectionString, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    }
}

