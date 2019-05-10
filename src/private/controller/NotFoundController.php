<?php

require_once config["CONTROLLER_FOLDER"] . "PageController.php";

class NotFoundController extends PageController
{
    public function __construct()
    {
        parent::__construct("ErrorPage.phtml", "Home");
    }


    protected function getData() : array    
    {
        return array
        (
            "title" => "Pagina niet gevonden",
            "errorMsg" => "Pagina \"" . strip_tags($_GET["page"]) . "\" Niet gevonden",
            "errorCode" => 404
        );
    }
}