<?php
/**
 * Created by PhpStorm.
 * User: michi
 * Date: 17-5-2019
 * Time: 09:21
 */

class WijzigGegController extends PageController
{

    public function __construct($db)
    {
        parent::__construct("profiel/WijzigGegevens.phtml", "Gegevens wijzigen", $db, true);
    }

    protected function getData(): array
    {
        return array();
    }


}