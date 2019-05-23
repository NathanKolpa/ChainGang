<?php
/**
 * Created by PhpStorm.
 * User: michi
 * Date: 15-5-2019
 * Time: 09:10
 */

class ProfielController extends PageController
{

    public function __construct($db)
    {
        parent::__construct("Profiel.phtml", "Profiel", $db);
    }

    protected function getData(): array
    {
        $usr = User::getUserByID($this->dataBase, $_SESSION["userid"]);


        return array("firstname" => $usr->getFirstName(), "lastname" => $usr->getLastName(), "email" => $usr->getEmail(),
            "adres" => $usr->getAdres());
    }
}