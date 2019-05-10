<?php


abstract class PageController extends Controller
{
    private $title;
    private $page;

    public function __construct($page, $title)
    {
        $this->title = $title;
        $this->page = $page;
    }

    abstract protected function getData() : array;
    public function createView()
    {

        $data = array
        (
            "title" => $this->title,
        );

        if(isset($_SESSION["user"]))
        {
            $data["user"] = $_SESSION["user"];
        }

        $this->loadView($this->page, array_merge($data, $this->getData()));
    }

}