<?php
/**
 * Created by PhpStorm.
 * User: michi
 * Date: 15-5-2019
 * Time: 10:05
 */

class BestellingController extends PageController
{
    public function __construct($db)
    {
        parent::__construct("profiel/Bestellingen.phtml", "Bestellingen", $db, true);
    }

    protected function getData() : array
    {
        return array();
    }
}