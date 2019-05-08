<?php

class DataBase
{

    private $dbConnection;

    public function __construct()
    {
        include config["CONFIG_FOLDER"] . "dbconfig.php";
        
        $this->dbConnection = new mysqli($serverName, $userName, $password);
        $this->dbConnection->set_charset("utf8");

        if ($this->dbConnection->connect_error)
        {
            die("Failed to connect to server: " . $serverName . " e:" . $connection->connect_error);
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