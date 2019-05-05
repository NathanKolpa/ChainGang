<?php
require_once config["CONTROLLER_FOLDER"] . "HomeController.php";

Route::addRoute("index.php", new HomeController());