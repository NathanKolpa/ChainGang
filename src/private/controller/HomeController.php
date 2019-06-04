<?php
require_once config["CLASS_FOLDER"] . "Review.php";
require_once config["CONTROLLER_FOLDER"] . "PageController.php";

class HomeController extends PageController
{
    public function __construct($db)
    {
        parent::__construct("Home.phtml", "Home", $db);

    }

    protected function getData() : array
    {

        $newProds = Product::getLatestProducts($this->dataBase, 12);
        $newRevs = Review::getLatestReviews($this->dataBase, 3);

        return array("newProducs" => $newProds);
        return array("newReviews => $newRevs");
    }

#




}

