<?php

class Catogorie
{
    private $dataBase;
    private $catogorieID;

    private function __construct($db, $id)
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
            $item = new Product($this->dataBase, $row["product_id"], $row["foto_url"],$row["product_price"], $row["product_stock"], $row["product_name"], $row["discription"]);

            array_push($arr, $item);
        }
        return $arr;

    }

    public static function getAllProducts($db) : array
    {
        $result = $db->querry("SELECT * FROM product", "");

        $results = $result->get_result();

        $arr = array();
        while($row = $results->fetch_assoc())
        {
            // hier wordt een object gemaakt van Product
            $item = new Product($db, $row["product_id"], $row["foto_url"],$row["product_price"], $row["product_stock"], $row["product_name"], $row["discription"]);

            array_push($arr, $item);
        }
        return $arr;
    }

    public static function searchCatogorieByName($db, $search)
    {
        $str = "%" . $search . "%";
        $result = $db->querry("SELECT * FROM catogorie WHERE catogorie_naam LIKE ?", "s", $str);
        $results = $result->get_result();

        if($row = $results->fetch_assoc())
        {
            return new Catogorie($db, $row["catogorie_id"]);
        }
        else
        {
            throw new Exception("Kan catogorie niet vinden");
        }
    }
}

?>
