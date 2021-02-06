<?php

define("DEBUG", true);

define("BASE_URL", "http://localhost/portifolio-api");

define("DATA_LAYER_CONFIG", [
    "driver" => "pgsql",
    "host" => "",
    "port" => "5432",
    "dbname" => "",
    "username" => "",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

define("TELEGRAM", [
    "bot_token" => "",
    "chat_id" => ""
]);

if (!DEBUG) {
    ini_set('display_errors', 0);
    error_reporting(0);
}

/* 
* HELPERS
*/

function json_response($code = 200, $data = null)
{
    header_remove();

    http_response_code($code);
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    header('Content-Type: application/json');

    echo json_encode($data);
}
