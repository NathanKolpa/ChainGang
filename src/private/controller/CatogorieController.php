<?php

require_once config["CONTROLLER_FOLDER"] . "PageController.php";


class CatogorieController extends PageController
{
    public function __construct($db)
    {
        parent::__construct("Catogorie.phtml", "Catogorie", $db);
    }

    protected function getData() : array
    {
        return array();
    }
}

?>
