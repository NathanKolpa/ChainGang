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
        if(isset($_SESSION["userid"]) && isset($_POST["title"]) && isset($_POST["body"]))
        {
            Review::postHomeReview($this->dataBase, User::getUserByID($this->dataBase, $_SESSION["userid"]), $_POST["title"], $_POST['body']);

            //to prevent resend on refresh
            $this->loadOtherPage(".");

            return array();
        }
        else
        {
            $newProds = Product::getLatestProducts($this->dataBase, 12);
            $newRevs = Review::getHomeReviews($this->dataBase, 7);
            $carosel = Product::getLatestProducts($this->dataBase, 4);
    
            return array("reviews" => $newRevs, "producten" => $newProds, "carosel" => $carosel);
        }
    }




}

