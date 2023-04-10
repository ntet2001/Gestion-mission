<?php

declare(strict_types = 1);

require_once "./src/Databases/Database.php";
require_once "./src/Databases/ConnectionQuery.php";

spl_autoload_register(function ($class){
    require __DIR__ . "/src/App/$class.php";
});


header("Content-type: application/json; charset=UTF-8");

//pour afficher les erreurs cote client.
//ini_set('display_errors', 'on');

/**
 * Here is the variable to seperate the url and get the parts of the route called
 */
$parts = explode ("/",$_SERVER['REQUEST_URI']); 
$id = $parts[3];


/**
 * Here we verified that is the route "missions" that is call with status or repport
 * And we return a status code of 404 if it's not the case
 */
if ($parts[2] != "users"){
    http_response_code(404);
    exit;
} 

//here is the connection to the database.
$database = new Database("localhost","gestion_mission","root","");

//here is my controller and i pass in input the database connection
$controller = new UsersController($database);

$database->getConnection();

//here is to print the controller result
/**
 * in input here i pass :
 * The server method, the id, the service
 */
print_r($controller->processRequest($_SERVER["REQUEST_METHOD"]));