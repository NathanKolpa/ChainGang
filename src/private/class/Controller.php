<?php

abstract class Controller
{


    /**
     * @param viewFile het bestand dat wordt geladen
     * @param data alle variablen die het view file kan gebruiken
     */
    protected function loadView(string $viewFile, array $data)
    {
        include config["VIEW_FOLDER"] . $viewFile;
    }

    /**
     * deze methode wordt aangeroepen om een view aan te maken
     * in deze functie moet je loadview aanroepen
     */
    abstract protected function createView();

    protected $route;

    public function start($route)
    {
        $this->route = $route;
        $this->createView();
    }
}