<?php

class User
{

    private $dataBase;
    private $isLoggedIn = false;
    private $userID = -1;

    public function __construct(DataBase $dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public static function tryLogin(DataBase $db, $email, $password) : ?User
    {
        $result = $db->querry("SELECT pwd_hash, user_id FROM users WHERE email = ?", "s", $email);

        $hash;
        $uID;
        $result->bind_result($hash, $uID);

        if($result->fetch())
        {

            //verify pwd
            if(password_verify($password, $hash))
            {//login sucess
                $usr = new User($db);
                $usr->isLoggedIn = true;
                $usr->userID = $uID;
                return $usr;
            }
        }

        return null;
    }

    public static function createNewUser(DataBase $db, string $firstName, string $lastName, string $password, string $email) : bool
    {
        //cannot use the same email
        $result = $db->querry("SELECT * FROM users WHERE email = ?", "s", $email);
        if($result->fetch())
        {
            //email exists
            return false;
        }
        else
        {
            $options = array
            (
                'cost' => 12,
            );
            $passwordHash = password_hash($password, PASSWORD_BCRYPT, $options) . "";

            $result = $db->querry("INSERT INTO users(pwd_hash, user_firstname, user_lastname, email) VALUES( ? , ? , ? , ? )", "ssss", $passwordHash, $firstName, $lastName, $email);   
            
            return true;
        }
    }

    public static function getUserByID($db, $id) : ?User
    {
        $result = $db->querry("SELECT user_id FROM users WHERE user_id = ?", "d", $id);
        
        $foo = -1;
        $result->bind_result($foo);

        if($result->fetch())
        {
            $user = new User($db);
            $user->userID = $foo;
            return $user;
        }

        return null;
    }

    public function getFullName() : ?string
    {
        if($this->userID != -1)
        {
            $result = $this->dataBase->querry("SELECT user_firstname, user_lastname FROM users WHERE user_id = ?", "d", $this->userID);
            $first;
            $last;

            $result->bind_result($first, $last);
            
            if($result->fetch())
            {
                return $first . " " . $last;
            }
        }
        return null;
    }

    public function getId() : int
    {
        return $this->userID;
    }
}