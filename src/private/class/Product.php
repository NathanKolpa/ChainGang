<?php

class product
{
    private $dataBase;
    private $productID = -1;

    private $merk;
    private $type;
    private $img;
    private $prijs;
    private $stock;
    private $discription;

    private $name;

    //bescrijving
    private $kleur;
    private $versnellingen;

    public function __construct($dataBase, $id,  $img, $prijs, $stock, $name, $discription)
    {
        $this->productID = $id;
        $this->dataBase = $dataBase;
        $this->img = $img;
        $this->prijs = $prijs;
        $this->stock = $stock;
        $this->name = $name;
        $this->discription = $discription;
    }

    public static function getLatestProducts($db, $limit) : array
    {
        $array = array();
        $result = $db->querry("SELECT * FROM product ORDER BY date_added DESC LIMIT ?", "i", $limit);


        $results = $result->get_result();

        //$arr = array();
        while($row = $results->fetch_assoc())
        {
            // hier wordt een object gemaakt van Product
            $item = new Product($db, $row["product_id"], $row["foto_url"], $row["product_price"], $row["product_stock"], $row["product_name"], $row["discription"] );

            array_push($array, $item);
        }


        return $array;}

    public static function getProductByID($db, $ID)
    {
        $result = $db->querry("SELECT * FROM product WHERE product_id = ?", "d", $ID);


        $results = $result->get_result();

        //$arr = array();
        if($row = $results->fetch_assoc())
        {
            // hier wordt een object gemaakt van Product
            $item = new Product($db, $row["product_id"], $row["foto_url"], $row["product_price"], $row["product_stock"], $row["product_name"], $row["discription"]);


            return $item;
            //array_push($arr, $item);
        }
        //return $arr;
        throw new Exception("product niet gevonden");
    }

    public static function searchProductsByName($db, $text) : array
    {
        $result = $db->querry("SELECT * FROM product WHERE product_name LIKE ?", "s", "%$text%");


        $results = $result->get_result();

        $arr = array();
        while($row = $results->fetch_assoc())
        {
            $item = new Product($db, $row["product_id"], $row["foto_url"], $row["product_price"], $row["product_stock"], $row["product_name"], $row["discription"]);

            array_push($arr, $item);
        }

        if(count($arr) <= 0)
        {
            throw new Exception("Geen producten gevonden");
        }

        return $arr;
    }


    // getters
    public function getMerk()
    {
        return $this->merk;
    }

    public function getType()
    {
        return $this->type;
    }


    public function getId() : int
    {
        return $this->productID;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrijs()
    {
        return $this->prijs;
    }

    public function getStock() : int
    {
        return $this->stock;
    }

    public function getImage()
    {
        return $this->img;
    }

    public function getDiscription()
    {
        return $this->discription;
    }


// setters alvast gemaakt voor het geval dat het nodig is
    public function setMerk($merk)
    {
        $this->merk = $merk;
    }

    public function setType($type)
    {
        $this->type = $type;
    }


    public function setId($id)
    {
        $this->productID = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrijs($prijs)
    {
        $this->prijs = $prijs;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function setImage($image)
    {
        $this->img = $image;
    }

    public function setCatogorie()
    {

    }


}

?>
