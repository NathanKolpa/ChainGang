<?php

class DataBase
{

    private $dbConnection;

    public function __construct($serverName, $userName, $password, $dbName)
    {
        
        $this->dbConnection = new mysqli($serverName, $userName, $password, $dbName);
        $this->dbConnection->set_charset("utf8");

        if ($this->dbConnection->connect_error)
        {
            die("Failed to connect to server: " . $serverName . " e:" . $this->dbConnection->connect_error);
        }
    }

    public function querry(string $querry, string $types, ...$parameters) : mysqli_stmt
    {
        $statement = $this->dbConnection->prepare($querry);
        $statement->bind_param($types, $parameters);

        if($statement->exec())
        {
            return $statement;
        }
        else
        {
            die($statement->error);
        }
    }
}