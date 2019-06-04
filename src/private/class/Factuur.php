<?php
/**
 * Created by PhpStorm.
 * User: michi
 * Date: 4-6-2019
 * Time: 13:00
 */

 require_once config["CLASS_FOLDER"] . "ShippingProduct.php";
class Factuur
{
    private $id;
    private $dataBase;
    private $shipProducts = array();


    public function __construct(DataBase $dataBase, $id, User $user)
    {
        $this->dataBase = $dataBase;
        $this->id = $id;


        $result = $this->dataBase->querry("SELECT * FROM shipped_product WHERE invoice_id = ?", "i", $this->id);

        $yeet = $result->get_result();


        while($row = $yeet->fetch_assoc())
        {
            array_push($this->shipProducts, new ShippingProduct(product::getProductByID($this->dataBase, $row["product_id"]), $row["product_count"]));
        }

    }

    public static function getFacturen(User $user, $database) : array
    {
        $result = $database->querry("SELECT * FROM invoice WHERE adress_id = (SELECT adress_id FROM shipping_adress WHERE user_id = ?)", "i", $user->getId());

        $yeet = $result->get_result();

        $arr = array();

        while($row = $yeet->fetch_assoc())
        {
            array_push($arr, new Factuur($database, $row["invoice_id"], $user));
        }
        return $arr;
    }

    public function getProducts() : array
    {
        return $this->shipProducts;
    }

    public function getTotal()
    {
        $total = 0;
        foreach($this->shipProducts as $ship)
        {
            $total += $ship->getTotal();
        }

        return $total;
    }


}