<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(BASE_URL);

/**
 * Controllers
 */
$router->namespace("Source\Controllers");

/**
 * API
 */
$router->group('api');
$router->get("/projects", "APIController:getProjects");
$router->post("/contact", "APIController:sendContact");

$router->dispatch();

if($router->error()){
    json_response($router->error(), 'Request error');
}
