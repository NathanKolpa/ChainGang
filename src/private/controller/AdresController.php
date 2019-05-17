<?php
/**
 * Created by PhpStorm.
 * User: michi
 * Date: 15-5-2019
 * Time: 15:29
 */

require_once config["CLASS_FOLDER"] . "Adres.php";

class AdresController extends PageController
{


    public function __construct($db)
    {
        parent::__construct("profiel/Adres.phtml", "Adres", $db);
    }

    protected function getData(): array
    {
        $usr = User::getUserByID($this->dataBase, $_SESSION["userid"]);
        $adr = Adres::getAdresses($this->dataBase, $usr);


        return array("adresses" => $adr);
    }
}