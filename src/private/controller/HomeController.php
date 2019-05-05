<?php

class HomeController extends Controller
{
    public function createView()
    {
        $this->loadView("Home.phtml", array("title" => "Home"));
    }
}