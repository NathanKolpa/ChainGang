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

    public function querry(string $querry, string $types, ...$params) : mysqli_stmt
    {
        if($statement = $this->dbConnection->prepare($querry))
        {
            if($types != "")
            {
                $statement->bind_param($types, ...$params);
            }
            $statement->execute();
            return $statement;
        }
        else
        {
            printf("Error: %s.\n", $this->dbConnection->error);
            return null;
        }
    }
}