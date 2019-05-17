<?php

class Adres
{
    private $street;
    private $housenumber;
    private $city;
    private $postCode;
    private $dataBase;

    public function __construct(DataBase $dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getHouseNumber()
    {
        return $this->housenumber;
    }
    public function getCity()
    {
        return $this->city;
    }

    public function getPostCode()
    {
        return $this->postCode;
    }

    public static  function getAdresses($database, $user) : array
    {
        $id = $user->getId();
        $result = $database->querry("SELECT * FROM shipping_adress WHERE user_id = ?", "d", $id);

        $yeet = $result->get_result();

        $arr = array();
        while($row = $yeet->fetch_assoc())
        {
            $adr = new Adres($database);
            $adr->street = $row["street"];
            $adr->housenumber = $row["housenumber"];
            $adr->city = $row["town"];
            $adr->postCode = $row["postcode"];

            array_push($arr, $adr);
        }

        return $arr;
    }

}