<?php
require_once config["CONTROLLER_FOLDER"] . "HomeController.php";
require_once config["CONTROLLER_FOLDER"] . "NotFoundController.php";

Route::addRoute("", new HomeController());
Route::addRoute("404", new NotFoundController());