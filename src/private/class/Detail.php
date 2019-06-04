<?php
class Detail
{
private $dataBase;

    public function __construct(DataBase $dataBase)
    {
        $this->dataBase = $dataBase;

    }

    public static function getProductByName($db, $name)
    {
        $result = $db->querry("SELECT * FROM product WHERE product_name= ?", "s", $name);

        $results = $result->get_result();

        if($row = $results->fetch_assoc())
        {
            // hier wordt een object gemaakt van Product
            $item = new Product($db, $row["foto_url"],$row["product_price"], $row["product_stock"], $row["product_name"], $row["discription"]);
            //$item->setId($row["product_id"]);
            return $item;

        }

    }
}

?>
