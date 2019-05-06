<?php

require_once config["CLASS_FOLDER"] . "Review.php";
class HomeController extends Controller
{
    public function createView()
    {
        $data = array("title" => "Home");
        $data["reviewArray"] = array(new Review(10, new User(), "Mijn review", "helemaal mooi", new DateTime(), 7.4, 0));

        $this->loadView("Home.phtml", $data);
    }
}