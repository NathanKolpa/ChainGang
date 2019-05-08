<?php

class DataBase
{

    private $dbConnection;

    public function __construct()
    {
        $serverName = "localhost";
        $userName = "nkolpa_root";
        $password = "pikhoofd123";
        $dbName = "chaingang";
        
        $this->dbConnection = new mysqli($serverName, $userName, $password);
        $this->dbConnection->set_charset("utf8");

        if ($this->dbConnection->connect_error)
        {
            die("Failed to connect to server: " . $serverName . " e:" . $this->dbConnection->connect_error);
        }
        else
        {
            if (!mysqli_select_db($this->dbConnection,$dbName))
            {
                die("Failed to use to data base: " . $dbName);
            }
        }
    }

    public function querry(string $querry)
    {
        return $this->dbConnection->multi_query($querry);
    }
}