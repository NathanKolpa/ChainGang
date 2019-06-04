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

        try
        {
            $prod = product::getProductByID($this->dataBase,$_GET["item"]);
        }
        catch(Exception $e)
        {
            $this->loadOtherPage("404");
        }


        return array("item" => $prod);

    }
}