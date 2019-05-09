<?php

abstract class User
{

    private $dataBase;
    private $isLoggedIn = false;

    public function __construct(DataBase $dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public static function tryLogin(DataBase $db, $email, $password) : User
    {
        if(true)
        {
            $user = new User($db);
            $user->isLoggedIn = true;
            return $user;
        }
        else
        {
            return null;
        }


    }

    public static function createNewUser(DataBase $db, $firstName, $lastName, $password, $email) : User
    {
        //cannot use the same email
        $result = $db->querry("SELECT * FROM USERS WHERE email = ?", "s", $email);
        if($result->fetch())
        {
            //email exists
            return null;
        }

        if(true)
        {
            $user = new User($db);
            return $user;
        }
        else
        {
            return null;
        }
    }


    public function getName() : string
    {
        return "b";
    }
}