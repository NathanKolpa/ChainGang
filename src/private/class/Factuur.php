<?php
/**
 * Created by PhpStorm.
 * User: michi
 * Date: 4-6-2019
 * Time: 13:00
 */

class Factuur
{
    private $id;
    private $dataBase;


    public function __construct(DataBase $dataBase, $id, User $user)
    {
        $this->dataBase = $dataBase;
        $this->id = $id;
    }

    public static function getFacturen(User $user, $database) : array
    {
        $result = $database->querry("SELECT * FROM invoice WHERE invoice_id = (SELECT adress_id FROM shipping_adress WHERE user_id = ?)", "i", $user->getId());

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
        $result = $this->dataBase->querry("SELECT * FROM shipped_product WHERE invoice_id = ?", "i", $this->id);

        $yeet = $result->get_result();

        $prod = array();

        while($row = $yeet->fetch_assoc())
        {
            array_push($prod, product::getProductByID($this->dataBase, $row["product_id"]));
        }
        return $prod;

    }


}