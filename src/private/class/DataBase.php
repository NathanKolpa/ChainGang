<?php

class DataBase
{

    private $dbConnection;

    public function __construct()
    {
        $serverName = "localhost";
        $userName = "nkolpa_root";
        $password = "pikhoofd123";
        
        $this->dbConnection = new mysqli($serverName, $userName, $password);
        $this->dbConnection->set_charset("utf8");

        if ($this->dbConnection->connect_error)
        {
            die("Failed to connect to server: " . $serverName . " e:" . $this->dbConnection->connect_error);
        }
        else
        {
            if ($this->dbConnection->query("USE nkolpa_chaingang") != TRUE)
            {
                die("Failed to connect to data base: " . "nkolpa_chaingang");
            }
        }
    }
}