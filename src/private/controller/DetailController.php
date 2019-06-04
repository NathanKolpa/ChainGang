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
        //urldecode() in geval dat het een $_POST is
        $product_name = $_GET['item_name'];
        $arr = Detail::getProductByName($this->dataBase, $product_name);
        return array("item" => $arr);

    }
}