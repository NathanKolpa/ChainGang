<?php


abstract class PageController extends Controller
{
    private $title;
    private $page;
    protected $dataBase;
    private $otherLoad = null;
    private $reqLogin;

    public function __construct($page, $title, $dataBase, $requiresLogin = false)
    {
        $this->title = $title;
        $this->page = $page;
        $this->dataBase = $dataBase;
        $this->reqLogin = $requiresLogin;
    }

    protected function setPage($page)
    {
        $this->page = $page;
    }

    protected function loadOtherPage(string $url)
    {
        $this->otherLoad = $url;
    }

    abstract protected function getData() : array;
    public function createView()
    {
        $otherData = null;
        $data = array
        (
            "title" => $this->title,
            "base" => "",
            "page" => $this->route
        );

        if(!isset($_SESSION["userid"]) && $this->reqLogin)
        {
            $this->otherLoad = "login?return=$this->route";
        }
        else
        {
            $otherData = $this->getData();

            //logout
            if(isset($_GET["logout"]))
            {
                $_SESSION["userid"] = null;
            }

            if(isset($_SESSION["userid"]))
            {
                $data["user"] = User::getUserByID($this->dataBase, $_SESSION["userid"]);

            }
        }

        //get the base url
        $count = substr_count($this->route, '/');
        for($i = 0; $i < $count; $i++)
        {
            $data["base"] .= "../";
        }





        if($this->otherLoad == null)
        {
            $this->loadView($this->page, array_merge($data, $otherData));
        }
        else
        {
            //redirect
            header('Location: ' . $data["base"] . $this->otherLoad, false, true ? 301 : 302);
            exit();
        }
    }

}