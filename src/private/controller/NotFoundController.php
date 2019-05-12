<?php

require_once config["CONTROLLER_FOLDER"] . "PageController.php";

class NotFoundController extends PageController
{
    public function __construct($db)
    {
        parent::__construct("ErrorPage.phtml", "Pagina niet gevonden", $db);
    }


    protected function getData() : array    
    {
        return array
        (
            "errorMsg" => "Pagina \"" . strip_tags($_GET["page"]) . "\" Niet gevonden",
            "errorCode" => 404
        );
    }
}