<?php

require_once config["CONTROLLER_FOLDER"] . "PageController.php";

class HomeController extends PageController
{
    public function __construct()
    {
        parent::__construct("Home.phtml", "Home");
    }

    protected function getData() : array
    {
        return array();
    }
}