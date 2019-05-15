<?php

class Route
{

    private static $routes = array();

    /**
     * voegt een route toe
     * @param route de naam van de route
     * @param controller het controller object dat word aangeroepen als load page is aangeroepen
     */
    public static function addRoute(string $route, Controller $controller)
    {
        self::$routes[$route] = $controller;
    }

    /**
     * laadt de pagina
     * @param route de pagina die hij inlaad, als hij de pagina niet kan vinden pak hij de default 404 route
     */
    public static function loadPage($route)
    {
        if(isset(self::$routes[$route]))
        {//laad de pagina
            self::$routes[$route]->start($route);
        }
        else
        {//de pagina is niet gevonden
            if(isset(self::$routes["404"]))
            {//laad de 404 pagina als hij bestaat
                self::$routes["404"]->start($route);
            }
            else
            {//ander gewoon die
                die("<h1>Error 404</h1><p>Page '". strip_tags($route) ."' not found</p>");
            }

        }
    }
}