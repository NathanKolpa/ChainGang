<?php


require_once config["CLASS_FOLDER"] . "NewsLetter.php";
class User
{
    private $dataBase;
    private $isLoggedIn = false;
    private $userID = -1;

    private function __construct(DataBase $dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public static function tryLogin(DataBase $db, $email, $password)
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
            else
            {
                throw new Exception("Wachtwoord is niet correct");
            }
        }
        else
        {
            throw new Exception("Gebruiker niet gevonden");
        }

    }

    public static function getUserByID($db, $id)
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
        else
        {
            throw new Exception("User not found");
        }

    }

    public static function createNewUser(DataBase $db, string $firstName, string $lastName, string $password, string $email)
    {
        //cannot use the same email
        $result = $db->querry("SELECT * FROM users WHERE email = ?", "s", $email);
        if($result->fetch())
        {
            throw new Exception("Email al in gebruik");
        }
        else
        {
            $options = array
            (
                'cost' => 12,
            );
            $passwordHash = password_hash($password, PASSWORD_BCRYPT, $options) . "";

            $firstName = strip_tags($firstName);
            $lastName = strip_tags($lastName);
            $email = strip_tags($email);

            $allowSpam = NewsLetter::emailBestaat($db, $email) ? 1 : 0;

            $result = $db->querry("INSERT INTO users(pwd_hash, user_firstname, user_lastname, email, allow_newsletters) VALUES( ? , ? , ? , ?, ?)", "ssssi", $passwordHash, $firstName, $lastName, $email, $allowSpam);
            
            if($allowSpam)
            {
                NewsLetter::schrijfUit($db, $email);
            }

        }
    }

    public function getFirstName()
    {
        if($this->userID != -1)
        {
            $result = $this->dataBase->querry("SELECT user_firstname FROM users WHERE user_id = ?", "d", $this->userID);
            $first;

            $result->bind_result($first);

            if($result->fetch())
            {
                return $first;
            }
        }
        return null;
    }

    public function getLastName()
    {
        if($this->userID != -1)
        {
            $result = $this->dataBase->querry("SELECT user_lastname FROM users WHERE user_id = ?", "d", $this->userID);
            $last;

            $result->bind_result($last);

            if($result->fetch())
            {
                return $last;
            }
        }
        return null;
    }

    public function getEmail()
    {
        if($this->userID != -1)
        {
            $result = $this->dataBase->querry("SELECT email FROM users WHERE user_id = ?", "d", $this->userID);
            $email;

            $result->bind_result($email);

            if($result->fetch())
            {
                return $email;
            }
        }
        return null;
    }



    public function getFullName()
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

    public function wijzigen($firstname, $lastname, $email)
    {
        $result = $this->dataBase->querry("SELECT * FROM users WHERE email = ? AND user_id != ?", "sd", $email, $this->userID);

        if($result->fetch())
        {
            //email exists
            throw new Exception("Email is al ingebruik");
        }
        else
        {
            $firstname = strip_tags($firstname);
            $lastname = strip_tags($lastname);
            $email = strip_tags($email);

            $result = $this->dataBase->querry("UPDATE users SET user_firstname= ?, user_lastname= ?, email= ? WHERE user_id =?", "sssd", $firstname, $lastname, $email, $this->userID);

        }
    }
}