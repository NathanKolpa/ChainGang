<?php

require_once config["CONTROLLER_FOLDER"] . "PageController.php";

class LoginController extends PageController
{
    public function __construct($db)
    {
        parent::__construct("Login.phtml", "Login", $db);
    }

    protected function getData() : array
    {
        $data = array();

        if(isset($_POST["email"]) && isset($_POST["password"]))
        {
            $user = User::tryLogin($this->dataBase, $_POST["email"], $_POST["password"]);

            if($user != null)
            {
                $_SESSION["userid"] = $user->getId();

                if(isset($_GET["return"]) && $_GET["return"] != "")
                {
                    $this->loadOtherPage($_GET["return"]);
                }
            }
            else
            {
                $data["errorMsg"] = "Kan niet inloggen";
            }
        }

        return $data;
    }
}