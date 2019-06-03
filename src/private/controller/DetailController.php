<?php
/**
 * Created by PhpStorm.
 * User: michi
 * Date: 22-5-2019
 * Time: 14:27
 */

class DetailController extends PageController
{
    public function __construct($db)
    {
        parent::__construct("Detail.phtml", "Detail", $db, false);
    }

    protected function getData(): array
    {
        return array();
    }
}