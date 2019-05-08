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
);

//include basis dingen
require_once config["CLASS_FOLDER"] . "Route.php";
require_once config["CLASS_FOLDER"] . "Controller.php";

//set de routes
include "Routes.php";