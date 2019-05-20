<?php
require_once config["CONTROLLER_FOLDER"] . "HomeController.php";
require_once config["CONTROLLER_FOLDER"] . "NotFoundController.php";
require_once config["CONTROLLER_FOLDER"] . "LoginController.php";
require_once config["CONTROLLER_FOLDER"] . "RegisterController.php";
require_once config["CONTROLLER_FOLDER"] . "CatogorieController.php";
require_once config["CONTROLLER_FOLDER"] . "ProfielController.php";
require_once config["CONTROLLER_FOLDER"] . "BestellingController.php";
require_once config["CONTROLLER_FOLDER"] . "FacturenController.php";
require_once config["CONTROLLER_FOLDER"] . "AdresController.php";
require_once config["CONTROLLER_FOLDER"] . "WijzigGegController.php";

Route::addRoute("", new HomeController($dataBase));
Route::addRoute("home", new HomeController($dataBase));
Route::addRoute("404", new NotFoundController($dataBase));
Route::addRoute("login", new LoginController($dataBase));
Route::addRoute("register", new RegisterController($dataBase));
Route::addRoute("catogorie", new CatogorieController($dataBase));
Route::addRoute("profiel", new ProfielController($dataBase));
Route::addRoute("profiel/bestellingen", new BestellingController($dataBase));
Route::addRoute("profiel/facturen", new FacturenController($dataBase));
Route::addRoute("profiel/adres", new AdresController($dataBase));
Route::addRoute("profiel/wijzigen", new WijzigGegController($dataBase));
