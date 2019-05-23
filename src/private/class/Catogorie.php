<?php

class Catogorie
{
    private $dataBase;
    private $catogorieNaam;
    private $catogorieID;

    public function __construct($db, $id)
    {
        $this->dataBase = $db;
        $this->catogorieID = $id;
    }

public function getProducts() : array
    {
        $result = $this->dataBase->querry("SELECT * FROM product WHERE product_catogorie = ?", "d", $this->catogorieID);

        $results = $result->get_result();

        $arr = array();
        while($row = $results->fetch_assoc())
        {
            // hier wordt een object gemaakt van Product
            $item = new Product($this->dataBase, $row["foto_url"],$row["product_price"], $row["product_stock"], $row["product_name"]);

            array_push($arr, $item);
        }
        return $arr;

    }
}

?>
