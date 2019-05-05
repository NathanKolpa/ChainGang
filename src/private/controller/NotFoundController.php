<?php

class NotFoundController extends Controller
{
    public function createView()
    {
        $this->loadView("ErrorPage.phtml", array
        (
            "title" => "Pagina niet gevonden",
            "errorMsg" => "Pagina \"" . strip_tags($_GET["page"]) . "\" Niet gevonden",
            "errorCode" => 404
        ));
    }
}