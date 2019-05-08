<?php

class DataBase
{

    private $dbConnection;

    public function __construct()
    {
        $serverName = "localhost";
        $userName = "nkolpa_root";
        $password = "pikhoofd123";
        $dbName = "nkolpa_chaingang";
        
        $this->dbConnection = new mysqli($serverName, $userName, $password, $dbName);
       // $this->dbConnection->set_charset("utf8");

        if ($this->dbConnection->connect_error)
        {
            die("Failed to connect to server: " . $serverName . " e:" . $this->dbConnection->connect_error);
        }
    }

    public function querry(string $querry)
    {
        $result = $this->dbConnection->query($querry);
        if($result != false)
        {
            return $result;

        }
        else
        {
            die($result->error);
        }
    }
}