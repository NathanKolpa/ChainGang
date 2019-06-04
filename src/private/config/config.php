<?php

//private folder moet gedefined zijn
if(!('PRIVATE_FOLDER'))
{
    die("'PRIVATE_FOLDER' not defined");
}

const config = array
(
    "MODEL_FOLDER" => PRIVATE_FOLDER . "/model/",
    "VIEW_FOLDER" => PRIVATE_FOLDER . "/view/",
    "LIB_FOLDER" => PRIVATE_FOLDER . "/lib/",
    "CLASS_FOLDER" => PRIVATE_FOLDER . "" . "/class/",
    "CONTROLLER_FOLDER" => PRIVATE_FOLDER . "/controller/",
    "TEMPLATE_FOLDER" => PRIVATE_FOLDER . "/template/",
    "CONFIG_FOLDER" => PRIVATE_FOLDER . "/config/",
);


//include basis dingen
require_once config["CLASS_FOLDER"] . "Route.php";
require_once config["CLASS_FOLDER"] . "Controller.php";
require_once config["CLASS_FOLDER"] . "DataBase.php";
require_once config["CLASS_FOLDER"] . "User.php";

require_once config["CLASS_FOLDER"] . "Product.php";
require_once config["CLASS_FOLDER"] . "Catogorie.php";
require_once config["CLASS_FOLDER"] . "NewsLetter.php";

//define global database variable
$dataBase;
if(!in_array($_SERVER["REMOTE_ADDR"], ["127.0.0.1", "::1"]))
{//online
    $dataBase = new DataBase("localhost", "nkolpa_root", "pikhoofd123", "nkolpa_chaingang");
}
else
{//localhost
    $dataBase = new DataBase("localhost", "root", "", "chaingang");
}

//set de routes
include "Routes.php";