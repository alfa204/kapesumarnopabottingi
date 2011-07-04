<?php
    include_once '../connection/databaseHandler.php';
    include_once '../connection/sessionHandler.php';
    $database = new DatabaseHandler();
    $session = new SessionHandler();

    //Mendapatkan semua informasi dari form
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $statusAdmin = 0;

    //Menghilangkan kemungkinan sql injection
    $name = mysql_escape_string($name);
    $username = mysql_real_escape_string($username);
    $password = mysql_real_escape_string($password);
    $email = mysql_real_escape_string($email);

    $query =
    "INSERT INTO ".$database->t_poiuser."(
        name,
        username,
        password,
        email,
        status_admin
    ) VALUES (
        '".$name."',
        '".$username."',
        '".$password."',
        '".$email."',
        '".$statusAdmin."'
    )";

    if ($database->execQuery($query)) {
        header("location:../index.php?ref=regSuccess");
    }
    else {
        header("location:../index.php?ref=regFailed");
        die();
    }

?>