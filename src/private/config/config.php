<?php

if(!('PRIVATE_FOLDER'))
{
    die("'PRIVATE_FOLDER' not defined");
}

const config = array
(
    "MODEL_FOLDER" => PRIVATE_FOLDER . "/model/",
    "VIEW_FOLDER" => PRIVATE_FOLDER . "/view/",
    "LIB_FOLDER" => PRIVATE_FOLDER . "/lib/",
);