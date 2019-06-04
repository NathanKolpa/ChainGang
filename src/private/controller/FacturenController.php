<?php

require_once config["CLASS_FOLDER"] . "Factuur.php";

class FacturenController extends PageController
{
    public function __construct($db)
    {
        parent::__construct("profiel/Facturen.phtml", "Factuur", $db, true);
    }

    protected function getData() : array
    {
        $facturen = Factuur::getFacturen(User::getUserByID($this->dataBase, $_SESSION["userid"]), $this->dataBase);
        return array("facturen" => $facturen);
    }
}