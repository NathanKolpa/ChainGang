<?php
require_once config["CONTROLLER_FOLDER"] . "HomeController.php";
require_once config["CONTROLLER_FOLDER"] . "NotFoundController.php";
require_once config["CONTROLLER_FOLDER"] . "LoginController.php";
require_once config["CONTROLLER_FOLDER"] . "RegisterController.php";
require_once config["CONTROLLER_FOLDER"] . "CatogorieController.php";

Route::addRoute("", new HomeController($dataBase));
Route::addRoute("home", new HomeController($dataBase));
Route::addRoute("404", new NotFoundController($dataBase));
Route::addRoute("login", new LoginController($dataBase));
Route::addRoute("register", new RegisterController($dataBase));
Route::addRoute("catogorie", new CatogorieController($dataBase));