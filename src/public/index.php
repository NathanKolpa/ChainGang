<?php

session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);

//define("PRIVATE_FOLDER", "../private");
define("PRIVATE_FOLDER", realpath(dirname(__FILE__) . "/../private"));
require_once(PRIVATE_FOLDER . "/config/config.php");

require_once config["CLASS_FOLDER"] . "User.php";

echo User::getUserByID($dataBase, 1)->getFullName();

//echo $_GET["page"];
//Route::loadPage($_GET["page"]);