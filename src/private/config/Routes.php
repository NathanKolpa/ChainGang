<?php
require_once config["CONTROLLER_FOLDER"] . "HomeController.php";

Route::addRoute("", new HomeController());