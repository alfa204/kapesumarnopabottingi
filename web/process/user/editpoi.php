<?php

include_once '../../connection/databaseHandler.php';
include_once '../../connection/sessionHandler.php';
$database = new DatabaseHandler();
$session = new SessionHandler();

$poiname = $_GET['poiname'];

$poi_status = 5; //status=edited

// Get informasi dari form
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$imageurl = $_POST['imageurl'];
$imagefull = $_POST['imagefull'];
$imagereduced = $_POST['imagereduced'];
$imageicon = $_POST['imageicon'];
$imagewiki = $_POST['imagewiki'];
$deskripsi = $_POST['deskripsi'];
$kategori = $_POST['kategori'];

$query = "
    UPDATE ".$database->t_poi." SET 
    address='".$address."',
    phone='".$phone."',
    email='".$email."',
    imageURL='".$imageurl."',
    image_full='".$imagefull."',
    image_reduced='".$imagereduced."',
    image_icon='".$imageicon."',
    image_wiki='".$imagewiki."',
    deskripsi='".$deskripsi."',
    kategori='".$kategori."',
    poi_status_id=".$poi_status." 
    WHERE title='".$poiname."'";
$result = $database->execQuery($query);
?>
