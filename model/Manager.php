<?php


class Manager
{
    
    protected function dbConnect()
    {
        $connectionFile = fopen('config/connection.db', 'r');
        
        $connectionString = fgets($connectionFile);
        $user=fgets($connectionFile);
        $password=fgets($connectionFile);



        fclose($connectionFile);

        //echo $connectionString . ' / ' . $user . ' / ' . $password . '<br />';


        $db = new PDO('mysql:host=localhost;dbname=TimeManagement;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    }
}

