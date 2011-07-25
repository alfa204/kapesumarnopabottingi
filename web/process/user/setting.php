<?php

include_once '../../connection/databaseHandler.php';
include_once '../../connection/sessionHandler.php';
$database = new DatabaseHandler();
$session = new SessionHandler();

// Get informasi dari form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$query = "
    UPDATE ".$database->t_poiuser." SET 
    name='".$name."',
    email='".$email."',
    password='".$password."'
    WHERE username='".$session->username."'";
$result = $database->execQuery($query);
?>
