<?php
/**
 * Created by PhpStorm.
 * User: michi
 * Date: 17-5-2019
 * Time: 09:21
 */


class WijzigGegController extends PageController
{

    public function __construct($db)
    {
        parent::__construct("profiel/WijzigGegevens.phtml", "Gegevens wijzigen", $db, true);
    }

    protected function getData(): array
    {
        $error = null;
        if(isset($_POST["Voornaam"]) || isset($_POST["Achternaam"]) || isset($_POST["Email"]))
        {
            $usr = User::getUserByID($this->dataBase, $_SESSION["userid"]);

            $firstName = isset($_POST["Voornaam"]) && $_POST["Voornaam"] != "" ? $_POST["Voornaam"] : $usr->getFirstName();
            $lastName = isset($_POST["Achternaam"]) && $_POST["Achternaam"] != "" ? $_POST["Achternaam"] : $usr->getLastName();
            $email = isset($_POST["Email"]) && $_POST["Email"] != "" ? $_POST["Email"] : $usr->getEmail();


            try
            {
                $usr->wijzigen($firstName, $lastName, $email);
            }
            catch (Exception $e)
            {
                $error = $e->getMessage(); 
            }


        }

        return array("error" => $error);
    }


}