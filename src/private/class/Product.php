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

    public function __construct( $dataBase, $img, $prijs, $stock, $name, $discription)
    {
        $this->dataBase = $dataBase;
        $this->img = $img;
        $this->prijs = $prijs;
        $this->stock = $stock;
        $this->name = $name;
        $this->discription = $discription;
    }


    public static function getProductByID($db, $ID)
    {/*
        $result = $db->querry("SELECT * FROM product WHERE product_id = ?", "d", $ID);


        $results = $result->get_result();

        //$arr = array();
        if($row = $results->fetch_assoc())
        {
            // hier wordt een object gemaakt van Product
            $item = new Product($db);

            // en worden de private waardes met de database feld gevult
            $item->productID = $row["product_id"];
            $item->name = $row["product_name"];
            $item->prijs = $row["product_price"];
            $item->stock = $row["product_stock"];
            $item->img = $row["foto_url"];
            $item->catogorie = $row["product_catogorie"];

            return $item;
            //array_push($arr, $item);
        }
        //return $arr;
        throw new Exception("product niet gevonden");*/
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
