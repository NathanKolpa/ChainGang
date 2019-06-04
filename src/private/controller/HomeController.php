<?php

require_once config["CONTROLLER_FOLDER"] . "PageController.php";
require_once config["CLASS_FOLDER"] . "Review.php";

class HomeController extends PageController
{
    public function __construct($db)
    {
        parent::__construct("Home.phtml", "Home", $db);
    }

    protected function getData() : array
    {
        
        return array("reviews" => Review::getHomeReviews($this->dataBase));
    }
}