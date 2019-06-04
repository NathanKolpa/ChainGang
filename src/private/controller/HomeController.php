<?php
require_once config["CLASS_FOLDER"] . "Review.php";
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

        $newProds = Product::getLatestProducts($this->dataBase, 12);
        $newRevs = Review::getHomeReviews($this->dataBase, 7);


        return array("reviews" => $newRevs, "producten" => $newProds);
    }




}

