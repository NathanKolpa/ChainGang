<?php
/**
 * Created by PhpStorm.
 * User: michi
 * Date: 15-5-2019
 * Time: 13:00
 */

class FacturenController extends PageController
{
    public function __construct($db)
    {
        parent::__construct("profiel/Facturen.phtml", "Factuur", $db);
    }

    protected function getData() : array
    {
        return array();
    }
}